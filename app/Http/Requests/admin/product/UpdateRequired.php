<?php

namespace App\Http\Requests\admin\product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequired extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public function rules(): array
    {
        // hỗ trợ cả route /products/{id}
        $productId = $this->route('product')?->id ?? $this->route('id');

        return [
            'images'        => ['nullable', 'array'],
            'images.*'      => ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],

            'barcode'       => ['nullable', 'string', 'min:4', 'max:50'],

            'name' => [
                'nullable',
                'string',
                'max:180',
                Rule::unique('products', 'name')->ignore($productId),
            ],

            'price'         => ['nullable', 'integer', 'min:0'],

            'supplier_id'   => ['nullable', 'integer', 'exists:suppliers,id'],
            'category_id'   => ['nullable', 'integer', 'exists:categories,id'],

            'slug' => [
                'nullable',
                'string',
                'max:40',
                Rule::unique('products', 'slug')->ignore($productId),
            ],

            'description'   => ['nullable', 'string'],
        ];
    }
}
