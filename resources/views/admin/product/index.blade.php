@extends('admin.index')
@section('adminContent')
<a class="btn btn-sm btn-info mb-2" 
        href="{{route('admin.categories.create')}}">
            + Thêm thể loại
        </a>
    </div>
    <div class="table-responsive">
    <table class="table table-striped table-hover table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Code</th>
                <th>Tên </th>
                <th>Giá</th>
                <th>Tồn kho</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $dataload)
                <tr>
                    <td>{{$dataload->barcode}}</td>
                    <td><a href="">{{$dataload->name}}</a></td>
                    <td>{{$dataload->price}}</td>
                    <td>{{$dataload->stock_quantity}}</td>
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