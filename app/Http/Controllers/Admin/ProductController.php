<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\product\CreateRequired;

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
    public function CreatePOST(CreateRequired $request){
        $data=$request->validated();
        $post=Product::create([
            'barcode'       =>$data['barcode'],
            'name'          =>$data('name'),
            'cost_price'    =>$data('cost_price'),
            'supplier_id'   =>$data('supplier_id'),
            'category_id'   =>$data('category_id'),
            'slug'          =>$data('slug'),
            'description'   =>$data('description'),
        ]);
        return redirect()->route('admin.product.index')->
        with('success', 'thêm sản phẩm thành công');
    }
}
