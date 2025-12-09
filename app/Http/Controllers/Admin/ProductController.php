<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

}
