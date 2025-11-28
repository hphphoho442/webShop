<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Category\CreateRequest;

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
}
