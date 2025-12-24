<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\client\address\create;

class AddressController extends Controller
{
    public function create(){
        return view('client.address.create');
    }
    public function store(create $request )
    {
        $validated = $request->validated();
        Address::create([
            'user_id'   => Auth::id(),
            'label'     => $validated['label'],
            'recipient' => $validated['recipient'],
            'phone'     => $validated['phone'],
            'line'      => $validated['line'],
            'ward'      => $validated['ward'],
            'district'  => $validated['district'],
            'province'  => $validated['province'],
            'country'   => 'VietNam',
        ]);

        return redirect()
            ->route('checkout.home')
            ->with('success', 'Đã thêm địa chỉ giao hàng');
    }
}
