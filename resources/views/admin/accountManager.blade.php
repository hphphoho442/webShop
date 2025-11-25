@extends('admin.index')
@section('adminContent')
    <div class="nav">
        <a class="btn btn-sm btn-info mb-2" href="{{route('admin.Account.Create')}}">
            + Thêm người dùng
        </a>
    </div>
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
                        <a class="btn btn-sm btn-primary" >Sửa</a>
                        <button class="btn btn-sm btn-danger">Xóa</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection