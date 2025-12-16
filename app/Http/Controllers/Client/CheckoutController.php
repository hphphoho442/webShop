<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
{
    $cart = Cart::with([
        'items.product.primaryImage'
    ])->where('user_id', Auth::id())->first();

    if (!$cart || $cart->items->isEmpty()) {
        return redirect()->route('cart.index')
            ->with('warning', 'Giỏ hàng trống');
    }

    $subtotal = 0;
    foreach ($cart->items as $item) {
        $subtotal += $item->product->price * $item->quantity;
    }

    $addresses = Address::where('user_id', Auth::id())->get();

    $paymentMethods = [
        'cod'   => 'Thanh toán khi nhận hàng (COD)',
        'bank'  => 'Chuyển khoản ngân hàng',
    ];

    return view('client.checkout.index', compact(
        'cart',
        'subtotal',
        'addresses',
        'paymentMethods'
    ));
}
}
