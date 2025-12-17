@extends('layouts.main')

@section('title', 'Đơn hàng của tôi')

@section('content')
<div class="container mt-4">
    <h2>📦 Đơn hàng của tôi</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info mt-3">
            Bạn chưa mua đơn hàng nào.
        </div>
    @else
        <table class="table mt-3 align-middle">
            <thead>
                <tr>
                    <th>Mã đơn</th>
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
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>{{ number_format($order->total_amount) }} đ</td>
                    <td>{{ strtoupper($order->payment->method ?? 'N/A') }}</td>
                    @php
                        $statusClasses = [
                            'pending'    => 'bg-warning text-dark',
                            'processing' => 'bg-info',
                            'shipped'    => 'bg-primary',
                            'completed'  => 'bg-success',
                            'cancelled'  => 'bg-danger',
                        ];
                    @endphp
                    <td>
                        <span class="badge {{ $statusClasses[$order->status] ?? 'bg-secondary' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('order.show', $order->id) }}"
                           class="btn btn-sm btn-outline-primary">
                            Chi tiết
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $orders->links() }}
    @endif
</div>
@endsection
