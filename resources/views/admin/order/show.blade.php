@extends('admin.index')

@section('title', 'Chi tiết đơn hàng')

@section('adminContent')
<div class="container mt-4">
    <h3>🧾 Đơn hàng #{{ $order->id }}</h3>

    <p>
        Khách hàng: <strong>{{ $order->user->name }}</strong><br>
        Email: {{ $order->user->email }}
    </p>

    <hr>

    <form method="POST"
          action="{{ route('admin.order.updateStatus', $order->id) }}">
        @csrf

        <label class="form-label">Trạng thái đơn hàng</label>
        <select name="status" class="form-select w-25">
            @foreach(['pending','processing','shipped','completed','cancelled'] as $status)
                <option value="{{ $status }}"
                    @selected($order->status === $status)>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>

        <button class="btn btn-primary mt-2">
            Cập nhật trạng thái
        </button>
    </form>

    <hr>

    <h5>📍 Địa chỉ giao hàng</h5>
    <p>
        {{ $order->shippingAddress->recipient }}<br>
        {{ $order->shippingAddress->phone }}<br>
        {{ $order->shippingAddress->line }},
        {{ $order->shippingAddress->ward }},
        {{ $order->shippingAddress->district }},
        {{ $order->shippingAddress->province }}
    </p>

    <hr>

    <h5>🛒 Sản phẩm</h5>
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>SL</th>
                <th>Giá</th>
                <th>Tạm tính</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->unit_price) }} đ</td>
                <td>{{ number_format($item->subtotal) }} đ</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
