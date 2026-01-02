<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use PHPUnit\Event\Code\Throwable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\product\CreateRequest;
use App\Http\Requests\admin\product\UpdateRequired;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // 🔍 Tên hoặc barcode
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                ->orWhere('barcode', 'like', "%{$keyword}%");
            });
        }

        // ✅ Trạng thái
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        // 🏭 Supplier
        if ($request->filled('supplier_id')) {
            $query->where('supplier_id', $request->supplier_id);
        }

        // 📂 Category
        if ($request->filled('category_id')) {

            $category = Category::with('children')
                ->find($request->category_id);

            if ($category) {
                // Lấy toàn bộ ID category cha + con
                $categoryIds = $category->getAllChildrenIds();

                $query->whereIn('category_id', $categoryIds);
            }
        }

        $data = $query
            ->orderByDesc('id')
            ->paginate(50)
            ->withQueryString();

        // Lấy danh sách để đổ select
        $suppliers = Supplier::orderBy('name')->get();
        $categories = Category::where('is_active', 1)->orderBy('name')->get();

        return view('admin.product.index', compact(
            'data',
            'suppliers',
            'categories'
        ));
    }
    public function Create(){
        return view('admin.product.create');
    }
    public function CreatePOST(CreateRequest $request){
        $data=$request->validated();
            DB::beginTransaction();
    try {
        $product = Product::create([
            'barcode'       =>$data['barcode'],
            'name'          =>$data['name'],
            'price'         =>$data['price'],
            'supplier_id'   =>$data['supplier_id'],
            'category_id'   =>$data['category_id'],
            'slug'          =>$data['slug'],
            'description'   =>$data['description'],
        ]);

        // nếu có ảnh
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            // chuẩn bị mảng để insert nhiều dòng 1 lần
            $rows = [];

            foreach ($files as $idx => $file) {

                // Lấy đuôi file gốc: jpg, png, webp...
                $ext = $file->getClientOriginalExtension();

                // Tạo timestamp
                $time = now()->format('YmdHis'); // ví dụ: 20251210_081030

                // Tạo tên file: productID-index-time.ext
                $filename = "{$product->id}-{$idx}-{$time}.{$ext}";

                // Lưu file vào thư mục public/products/{id}/
                $path = $file->storeAs("products/{$product->id}", $filename, 'public');

                // Push vào mảng insert
                $rows[] = [
                    'product_id' => $product->id,
                    'url'        => $path,
                    'is_primary' => ($idx === 0) ? 1 : 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }


            // insert nhiều bản ghi 1 lần (hấp dẫn và nhanh)
            DB::table('product_images')->insert($rows);
            // hoặc nếu muốn dùng Eloquent:
            // $product->images()->createMany(array_map(fn($r)=>Arr::except($r,['product_id']), $rows));
        }

            DB::commit();

            return redirect()->route('admin.product.index')->with('success','Thêm sản phẩm thành công');

        } catch (\Exception $e) {
            DB::rollBack();
            // nếu đã lưu file nhưng rollback DB, cân nhắc xóa file đã upload hoặc dùng try/catch riêng
            // log lỗi
            Log::error('Create product failed: '.$e->getMessage());
            return back()->withInput()->withErrors(['general' => 'Có lỗi xảy ra, thử lại.']);
        }
    }

    public function Update($id){
        $product = Product::with(['category','supplier','images'])->findOrFail($id);
        return view('admin.product.update',compact('product'));
    }
    public function updatePUT(updateRequired $request,$id) {
        $product = Product::findOrFail($id);
        \DB::beginTransaction();

        try {

            /**
             * =========================
             * 1. Lấy data đã validate
             * =========================
             */
            $data = collect($request->validated())
                ->filter(function ($value) {
                    // ❗ bỏ field rỗng hoặc null
                    return !($value === null || $value === '');
                })
                ->toArray();
            /**
             * =========================
             * 2. Xử lý slug tự sinh (nếu cần)
             * =========================
             */
            if (!empty($data['name']) && empty($data['slug'])) {
                $data['slug'] = \Illuminate\Support\Str::slug($data['name']);
            }

            /**
             * =========================
             * 3. Không cho images vào bảng products
             * =========================
             */
            unset($data['images']);

            /**
             * =========================
             * 4. Update product
             * =========================
             */
            if (!empty($data)) {
                $product->update($data);
            }

            /**
             * =========================
             * 5. Upload images (nếu có)
             * =========================
             */
            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $file) {
                    $ext = $file->getClientOriginalExtension();

                    // Tạo timestamp
                    $time = now()->format('YmdHis'); // ví dụ: 20251210_081030

                    // Tạo tên file: productID-index-time.ext
                    $filename = "{$product->id}-0-{$time}.{$ext}";

                    // Lưu file vào thư mục public/products/{id}/
                    $path = $file->storeAs("products/{$product->id}", $filename, 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'url'       => $path,
                        'is_primary' => $product->images()->count() === 0,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('admin.product.LoadImage', $product->id)
                ->with('success', 'Cập nhật sản phẩm thành công');

        } catch (Throwable $e) {
            dd($e);
            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors([
                    'error' => 'Có lỗi xảy ra khi cập nhật sản phẩm'
                ]);
        }
    }

    public function Delete($id){
        $item=Product::findOrFail($id);
        $data=$item->delete();
        return redirect()->
        route('admin.product.index')->
        with('success','Xóa sản phẩm thành công');
    }
    public function LoadImage($id)
    {
        // lấy product và các ảnh liên quan
        $product = Product::with(['category','supplier','images'])->findOrFail($id);

        // debug nếu cần:
        // dd($product->images->toArray());

        return view('admin.product.showDetail', compact('product'));
    }
    public function ToggleActive(Product $product)
    {
    $product->update([
        'is_active' => $product->is_active == 1 ? 0 : 1
    ]);

    return response()->json([
        'success' => true,
        'is_active' => $product->is_active
    ]);
    }
}
