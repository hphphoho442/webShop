<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index(){
        $data=Category::all();
        return view('admin.categories.index',
        compact('data'));
    }
    public function update($id){
        $data=Category::findOrFail($id);
        return view('admin.categories.updateCategory',
                compact('data'));
    }
}
