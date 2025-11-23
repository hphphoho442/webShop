@extends('admin.dashboardManager')
@section('adminContent')
    <div class="table-responsive">
    <table class="table table-striped table-hover table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Quyền</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            @foreach($accountList as $accountList)
                <tr>
                    <td>{{$accountList->id}}</td>
                    <td>{{$accountList->name}}</td>
                    <td>{{$accountList->email}}</td>
                    <td>{{$accountList->role}}</td>
                    <td>
                        <button class="btn btn-sm btn-primary">Sửa</button>
                        <button class="btn btn-sm btn-danger">Xóa</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection