<?php

namespace App\Http\Controllers\admin;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\supplier\createRequest;
use App\Http\Requests\admin\supplier\updateRequest;

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
            'email'=>$data['email'],
            'address'=>$data['address'],
        ]);
        return redirect()->route('admin.supplier.index')
            ->with('success','Thêm NCC thành công');
    }
    public function update($id){
        $data=Supplier::findOrFail($id);
        return view('admin.supplier.update',
                compact('data'));
    }
    public function updatePUT(UpdateRequest $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        // sau đó copy logic giống bên trên
        $data = $request->validated();
        
        
        
        $filtered = array_filter($data, fn($v) => $v !== null && $v !== '');
        
        // \Log::debug('validated', $data);
        // \Log::debug('filtered', $filtered);
        // \Log::debug('keys_filtered', array_keys($filtered));
        // dd($data, $filtered, !($request->input('contact')===null));
        $supplier->fill($filtered);

        if (!($request->input('contact')===null)) {
            $supplier->contact_name = $request->input('contact');
        }
        if (!($request->input('name')===null)) {
            $supplier->name = $request->input('name');
        }
        if (!($request->input('phone')===null)) {
            $supplier->phone = $request->input('phone');
        }
        if (!($request->input('email')===null)) {
            $supplier->email = $request->input('email');
        }
        if (!($request->input('address')===null)) {
            $supplier->address = $request->input('address');
        }

        $supplier->save();

        return redirect()->route('admin.supplier.index')->with('success', 'Cập nhật thành công');
    }
    public function Delete($id){
        $item=Supplier::findOrFail($id);
        $data=$item->delete();
        return redirect()->
            route('admin.supplier.index')->
            with('success','Xóa thành Công');
    }
    public function search(Request $request){
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
