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
        $data=Category::with('parent')->get();
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
}
