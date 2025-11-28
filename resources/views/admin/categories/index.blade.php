@extends('admin.index')
@section('adminContent')
    <div class="nav">
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
            @foreach($data as $data)
                <tr>
                    <td>{{$data->id}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->parent->name ?? '-'}}</td>
                    <td>{{$data->slug}}</td>
                    <td>{{$data->discription}}</td>
                    <td>
                        <a class="btn btn-sm btn-primary" 
                        href="{{route('admin.categories.update', 
                            ['id'=>$data->id])}}">Sửa</a>
                        <a class="btn btn-sm btn-danger"
                            {{-- href="{{route('admin.Account.Delete', ['id'=>$accountList->id])}}"> --}}
                            >
                            Xóa
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection