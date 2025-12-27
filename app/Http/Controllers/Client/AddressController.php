<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;


class AddressController extends Controller
{
public function index()
    {
        $addresses = Auth::user()->addresses()->latest()->get();
        return view('client.address.index', compact('addresses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'label' => 'nullable|string|max:100',
            'recipient' => 'required|string|max:150',
            'phone' => 'required|string|max:20',
            'line' => 'required|string|max:255',
            'ward' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'country' => 'required|string|max:100',
        ]);

        $data['user_id'] = Auth::id();

        Address::create($data);

        return back()->with('success', 'Đã thêm địa chỉ mới');
    }

    public function destroy($id)
    {
        $address = Auth::user()->addresses()->findOrFail($id);
        $address->delete();

        return back()->with('success', 'Đã xoá địa chỉ');
    }
}
