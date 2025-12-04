<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $data = Product::paginate(20);
        return view('admin.product.index',
                    compact('data'));
    }
}
