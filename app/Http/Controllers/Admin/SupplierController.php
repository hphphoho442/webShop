<?php

namespace App\Http\Controllers\admin;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\supplier\createRequest;

class SupplierController extends Controller
{
    public function index(){
        $data = Supplier::paginate(20);
        return view('admin.supplier.index', 
            compact('data'));
    }
    public function create(){
        return view('admin.supplier.create');
    }
    public function createPOST(createRequest $request){
        $data=$request->validated();
        $post=Supplier::create([
            'Contact_Name'=>$data['contact'],
            'name'=>$data['name'],
            'phone'=>$data['phone'],
            'email'=>$data['Email'],
            'address'=>$data['address'],
        ]);
        return redirect()->route('admin.supplier.index')
            ->with('success','Thêm NCC thành công');
    }
}
