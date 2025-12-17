<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('payments')
            ->latest()
            ->paginate(10);

        return view('client.order.index', compact('orders'));
    }
    public function store(Request $request)
    {
        // 1️⃣ Validate input từ checkout
        $validated = $request->validate([
            'shipping_address_id' => 'required|exists:addresses,id',
            'payment_method'      => 'required|in:cod,bank,card,wallet',
        ]);

        // 2️⃣ Lấy cart của user
        $cart = Cart::with('items.product')
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return back()->with('error', 'Giỏ hàng trống');
        }

        DB::beginTransaction();

        try {
            // 3️⃣ Tính tiền
            $subtotal = 0;
            foreach ($cart->items as $item) {
                if (!$item->product) {
                    throw new \Exception('Sản phẩm không tồn tại');
                }

                $subtotal += $item->product->price * $item->quantity;
            }

            // 4️⃣ Tạo order
            $order = Order::create([
                'user_id'             => Auth::id(),
                'shipping_address_id' => $validated['shipping_address_id'],
                'billing_address_id'  => $validated['shipping_address_id'],
                'status'              => 'pending',   // chờ xử lý
                'payment_status'      => 'unpaid',
                'subtotal_amount'     => $subtotal,
                'total_amount'        => $subtotal,
            ]);

            // 5️⃣ Tạo order_items
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item->product->id,
                    'product_name' => $item->product->name,
                    'unit_price'   => $item->product->price,
                    'quantity'     => $item->quantity,
                    'subtotal'     => $item->product->price * $item->quantity,
                ]);
            }

            // 6️⃣ Tạo payment
            Payment::create([
                'order_id' => $order->id,
                'method'   => $validated['payment_method'],
                'amount'   => $order->total_amount,
                'status'   => 'pending',
            ]);

            // 7️⃣ Clear cart
            $cart->items()->delete();
            $cart->delete();

            DB::commit();

            // 8️⃣ Redirect sang trang xác nhận
            return redirect()
                ->route('order.show', compact('order'))
                ->with('success', 'Đặt hàng thành công 🎉');

        } catch (\Throwable $e) {
            DB::rollBack();

            return back()->with('error', 'Không thể tạo đơn hàng');
        }
    }
    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load([
            'items',
            'payments',
            'shippingAddress'
        ]);

        return view('client.order.show', compact('order'));
    }
    public function cancel(Order $order)
{
    // 1️⃣ Chỉ chủ đơn mới được hủy
    if ($order->user_id !== Auth::id()) {
        abort(403);
    }

    // 2️⃣ Chỉ hủy khi đang pending
    if ($order->status !== 'pending') {
        return back()->with('error', 'Không thể hủy đơn hàng này');
    }

    DB::beginTransaction();

    try {
        // 3️⃣ Update trạng thái đơn
        $order->update([
            'status' => 'cancelled'
        ]);

        // 4️⃣ Update trạng thái payment
        if ($order->payment) {
            $order->payment->update([
                'status' => 'cancelled'
            ]);
        }

        DB::commit();

        return redirect()
            ->route('orders.show', $order->id)
            ->with('success', 'Đã hủy đơn hàng');

    } catch (\Throwable $e) {
        DB::rollBack();

        return back()->with('error', 'Hủy đơn thất bại');
    }
}
}
