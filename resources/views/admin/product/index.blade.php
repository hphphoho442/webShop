@extends('admin.index')
@section('js')
    @vite('resources/js/admin/Product/toggle_Active.js')
@endsection
@section('adminContent')
<a class="btn btn-sm btn-info mb-2" 
        href="{{route('admin.product.create')}}">
            + Sản phẩm
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
                    <td><a href="{{route('admin.product.LoadImage',
                         $dataload->id)}}">{{$dataload->name}}</a></td>
                    <td>{{number_format($dataload->price, 0, ',', '.')}}</td>
                    <td>{{$dataload->stock_quantity}}</td>
                    <td>
    <div class="form-check form-switch">
        <input 
            class="form-check-input toggle-active"
            type="checkbox"
            data-id="{{ $dataload->id }}"
            {{ $dataload->is_active ? 'checked' : '' }}
        >
    </div>
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