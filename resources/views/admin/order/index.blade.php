@extends('admin.index')

@section('title', 'Quản lý đơn hàng')

@section('adminContent')
<div class="container mt-4">
    <h2>📦 Quản lý đơn hàng</h2>

    <table class="table mt-3 align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Khách hàng</th>
                <th>Ngày</th>
                <th>Tổng tiền</th>
                <th>Thanh toán</th>
                <th>Trạng thái</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                <td>{{ number_format($order->total_amount) }} đ</td>
                <td>{{ $order->payment->status ?? 'N/A' }}</td>
                <td>
                    <span class="badge bg-info">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.order.show', $order->id) }}"
                       class="btn btn-sm btn-outline-primary">
                        Chi tiết
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
</div>
@endsection
