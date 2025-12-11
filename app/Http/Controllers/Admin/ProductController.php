<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\product\CreateRequest;

class ProductController extends Controller
{
    public function index(){
        $data = Product::paginate(20);
        return view('admin.product.index',
                    compact('data'));
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
            \DB::table('product_images')->insert($rows);
            // hoặc nếu muốn dùng Eloquent:
            // $product->images()->createMany(array_map(fn($r)=>Arr::except($r,['product_id']), $rows));
        }

            DB::commit();

            return redirect()->route('admin.product.index')->with('success','Thêm sản phẩm thành công');

        } catch (\Exception $e) {
            DB::rollBack();
            // nếu đã lưu file nhưng rollback DB, cân nhắc xóa file đã upload hoặc dùng try/catch riêng
            // log lỗi
            \Log::error('Create product failed: '.$e->getMessage());
            return back()->withInput()->withErrors(['general' => 'Có lỗi xảy ra, thử lại.']);
        }
    }

    public function Update($id){
        return view('admin.product.update');
    }
    public function Delete($id){
        return view('admin.product');
    }
public function LoadImage($id)
{
    // lấy product và các ảnh liên quan
    $product = Product::with(['images'])->findOrFail($id);

    // debug nếu cần:
    // dd($product->images->toArray());

    return view('admin.product.showImages', compact('product'));
}

}
