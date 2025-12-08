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
    public function search(Request $request)
{
    $q = trim($request->query('q'));

    if ($q === '') {
        return response()->json([]);
    }

    $suppliers = Supplier::where('name', 'like', "%{$q}%")
        ->orWhere('phone', 'like', "%{$q}%")
        ->orWhere('email', 'like', "%{$q}%")
        ->limit(10)
        ->get(['id', 'name', 'phone', 'email']);

    return response()->json($suppliers);
}


}
