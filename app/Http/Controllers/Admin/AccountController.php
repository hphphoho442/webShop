<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\admin\Account\Store;

class AccountController extends Controller
{
    public function Create(){
        return view('admin.createAccount');
    }
    public function Store(Store $request){
        $data = $request->validated();
        $user = User::create([
            'name'=>$data['username'],
            'email'=>$data['email'],
            'phone'=>$data['phone'],
            'password'=>Hash::make($data['password']),
            'role'=>$data['role'],
        ]);
        return redirect()
            ->route('admin.Account')
            ->with('success', 'Tạo user mới thành công!');
    }
}
