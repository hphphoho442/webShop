<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['payments', 'shippingAddress', 'user'])
            ->latest()
            ->paginate(50);

        return view('admin.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load([
            'items',
            'payments',
            'shippingAddress',
            'user'
        ]);

        return view('admin.order.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        // Nếu hoàn tất → đánh dấu đã thanh toán
        if ($request->status === 'completed' && $order->payment) {
            $order->payment->update([
                'status'  => 'paid',
                'paid_at' => now(),
            ]);
        }

        return back()->with('success', 'Cập nhật trạng thái đơn hàng thành công');
    }
}
