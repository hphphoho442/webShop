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
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>
                    <a href="{{ route('admin.order.show', $order->id) }}" 
                    class="nav">
                        {{ $order->id }}
                    </a>
                </td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                <td>{{ number_format($order->total_amount) }} đ</td>
                <td>
                    @php
                        $statusClasses = [
                            'pending'    => 'bg-warning text-dark',
                            'processing' => 'bg-info',
                            'shipped'    => 'bg-primary',
                            'completed'  => 'bg-success',
                            'cancelled'  => 'bg-danger',
                        ];
                    @endphp
                        <span class="badge {{ $statusClasses[$order->status] ?? 'bg-secondary' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
</div>
@endsection
