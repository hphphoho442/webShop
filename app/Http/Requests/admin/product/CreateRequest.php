<?php

namespace App\Http\Requests\admin\product;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->User()->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'images'        => 'nullable|array',
            'images.*'      => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'barcode'       => 'required|string|min:4|max:50',
            'name'          => 'required|string|max:180|unique:products,name',
            'price'         => 'required|integer|min:0',
            'supplier_id'   => 'required|integer|exists:suppliers,id',
            'category_id'   => 'required|integer|exists:categories,id',
            'slug'          => 'nullable|string|max:40|unique:products,slug',
            'description'   => 'nullable|string',
        ];
    }
}
