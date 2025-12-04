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
                <th>#</th>
                <th>Loại</th>
                <th>Loại cha</th>
                <th>Đường dẫn</th>
                <th>Miêu tả</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $dataload)
                <tr>
                    <td>{{$dataload->id}}</td>
                    <td>{{$dataload->name}}</td>
                    <td>{{$dataload->parent->name ?? '-'}}</td>
                    <td>{{$dataload->slug}}</td>
                    <td>{{$dataload->discription}}</td>
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