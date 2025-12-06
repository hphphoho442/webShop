@extends('admin.index')
@section('adminContent')
<a class="btn btn-sm btn-info mb-2" 
        href="{{route('admin.supplier.create')}}">
            + Thêm NCC
        </a>
    </div>
    <div class="table-responsive">
    <table class="table table-striped table-hover table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Tên NCC</th>
                <th>SĐT</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Chức năng</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $dataload)
                <tr>
                    <td>{{$dataload->name}}</td>
                    <td>{{$dataload->phone}}</td>
                    <td>{{$dataload->email}}</td>
                    <td>{{$dataload->address}}</td>
                    <td>
                        <a class="btn btn-sm btn-primary" 
                        href="{{route('admin.categories.update', 
                            ['id'=>$dataload->id])}}">Sửa</a>
                        <a class="btn btn-sm btn-danger"
                            href="{{route('admin.categories.Delete',
                             ['id'=>$dataload->id])}}">
                            Xóa
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-3 d-flex justify-content-end">
    {{ $data->links() }}
</div>
@endsection