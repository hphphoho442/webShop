@extends('admin.index')

@section('title', 'Admin Dashboard')

@section('adminContent')
<div class="container mt-4">
    <h2>📊 Dashboard</h2>

    {{-- FILTER --}}
    <form class="row g-3 mb-4">
    <div class="col-md-4">
        <label class="form-label">Từ ngày</label>
        <input type="date"
               name="from"
               class="form-control"
               value="{{ $from }}">
    </div>

    <div class="col-md-4">
        <label class="form-label">Đến ngày</label>
        <input type="date"
               name="to"
               class="form-control"
               value="{{ $to }}">
    </div>

    <div class="col-md-4 d-flex align-items-end">
        <button class="btn btn-primary w-100">
            Lọc dữ liệu
        </button>
    </div>
</form>
<div class="alert alert-info">
    Thống kê từ <strong>{{ $from }}</strong>
    đến <strong>{{ $to }}</strong>
</div>


    {{-- KPI --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Tổng doanh thu</h6>
                    <h3 class="text-success">
                        {{ number_format($totalRevenue) }} đ
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Tổng đơn hàng</h6>
                    <h3>{{ $totalOrders }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- ORDERS STATUS --}}
    <h5>📦 Đơn hàng theo trạng thái</h5>
    <table class="table mb-4">
        @foreach($ordersByStatus as $status => $count)
            <tr>
                <td>{{ ucfirst($status) }}</td>
                <td>{{ $count }}</td>
            </tr>
        @endforeach
    </table>

    {{-- USERS ROLE --}}
    <h5>👤 Tài khoản theo role</h5>
    <table class="table">
        @foreach($usersByRole as $role => $count)
            <tr>
                <td>{{ ucfirst($role) }}</td>
                <td>{{ $count }}</td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
