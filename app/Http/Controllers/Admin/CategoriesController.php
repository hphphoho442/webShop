<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Category\CreateRequest;
use App\Http\Requests\admin\Category\UpdateRequest;

class CategoriesController extends Controller
{
    public function index(){
        $data=Category::with('parent')->paginate(3);
        return view('admin.categories.index',
        compact('data'));
    }
    public function update($id){
        $data=Category::with('parent')->findOrFail($id);
        $categories=Category::with('parent')->get();
        return view('admin.categories.updateCategory',
                compact('data', 'categories'));
    }
    public function create(){
        $categories=Category::with('parent')->get();
        return view('admin.categories.createCategory', compact('categories'));
    }
    public function CreatePOST(CreateRequest $request){
        $data=$request->validated();
        $category= Category::create([
            'name'=>$data['name'],
            'parent_id'=>$data['parent_id'],
            'description'=>$data['description'],
            'slug'=>$data['slug'],
        ]);
        return redirect()->route('admin.categories.index')
                 ->with('success', 'Category created successfully!');
    }
public function UpdatePUT(UpdateRequest $request, $id)
{
    $category = Category::findOrFail($id); // ✅ Lấy category theo id

    $data = $request->validated();
    $parentId = $data['parent_id'] ?? null;

    $data = array_filter(
        $data,
        function ($value, $key) {
            if ($key === 'parent_id') return true;
            return $value !== null && $value !== '';
        },
        ARRAY_FILTER_USE_BOTH
    );

    $category->fill($data);

    if ($request->has('parent_id')) {
        $category->parent_id = ($parentId === '' || $parentId === null) ? null : $parentId;
    }

    $category->save(); // ✅ Lúc này chắc chắn là UPDATE

    return redirect()->route('admin.categories.index')
                     ->with('success', 'Category updated successfully!');
}
    public function destroy($id){
        $category=Category::findOrFail($id);
        $category->delete();
         return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Xóa thông tin thành công');
    }
public function search(Request $request)
{
    $q = trim($request->query('q', ''));

    if ($q === '') {
        return response()->json([]);
    }

    $categories = Category::with('parent:id,name')
        ->where(function ($query) use ($q) {
            $query->where('name', 'like', "%{$q}%")
                  ->orWhere('slug', 'like', "%{$q}%");
        })
        ->orWhereHas('parent', function ($q2) use ($q) {
            $q2->where('name', 'like', "%{$q}%");
        })
        ->get(['id', 'name', 'slug', 'parent_id']);

    $out = $categories->map(function ($c) {
        return [
            'id' => $c->id,
            'name' => $c->name,
            'slug' => $c->slug,
            'parent_id' => $c->parent_id,
            'parent_name' => $c->parent->name ?? null,
        ];
    });

    return response()->json($out);
}

}
