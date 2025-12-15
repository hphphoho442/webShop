<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::with(['images'])->get();
        return view('client.shop.index', compact('products'));
    }
}
