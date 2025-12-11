@extends('admin.index')
@section('adminContent')

@php $primary = $product->images->first(); @endphp

<img 
  src="{{ $primary ? Storage::url($primary->url) : asset('images/placeholder.png') }}" 
  alt="{{ $product->name }}" 
  style="max-width:100%; height:auto;"
>

<div class="product-gallery">
  @forelse($product->images as $img)
    <img 
      src="{{ Storage::url($img->url) }}" 
      alt="{{ $product->name }} - ảnh {{ $loop->iteration }}" 
      width="150" height="150"
      loading="lazy"
      style="object-fit:cover; margin-right:8px;"
    />
  @empty
    <p>Chưa có ảnh</p>
  @endforelse
</div>

@endsection
