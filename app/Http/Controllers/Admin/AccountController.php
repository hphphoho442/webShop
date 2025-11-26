<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\admin\Account\Store;

class AccountController extends Controller
{   
    public function AccountManager(){
        $accountList = User::all();
        return view('admin.Account.accountManager', 
            compact('accountList'));
    }
    public function Create(){
        return view('admin.Account.createAccount');
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

    public function update($id){
        $data = User::findOrFail($id);
        return view('admin.Account.updateAccount', compact('data'));
    }
    public function UpdatePUT($id, Store $request){
        $data=$request->validated();
        $user=User::findOrFail($id);
        $user->update([
            'name'=>$data['username'],
            'email'=>$data['email'],
            'phone'=>$data['phone'],
            'password'=>Hash::make($data['password']),
            'role'=>$data['role'],
        ]);
        return redirect()
            ->route('admin.Account')
            ->with('success', 'Cập nhật thông tin thành công');
    }
    public function destroy($id){
        $user=User::findOrFail($id);
        $user->delete();
         return redirect()
            ->route('admin.Account')
            ->with('success', 'Cập nhật thông tin thành công');
    }
}
