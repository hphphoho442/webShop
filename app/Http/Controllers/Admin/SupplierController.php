<?php

namespace App\Http\Controllers\admin;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    public function index(){
        $data = Supplier::paginate(20);
        return view('admin.supplier.index', 
            compact('data'));
    }
}
