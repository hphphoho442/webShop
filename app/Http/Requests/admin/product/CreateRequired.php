<?php

namespace App\Http\Requests\admin\product;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequired extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check()&&auth()->User()->role==='admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'barcode'       =>'requies|string|min:4|max:50',
            'name'          =>'requies|string|max:100|unique:products,name',
            'cost_price'    =>'requies|integer|min:0',
            'supplier_id'   =>'requies|integer|exists:suppliers,id',
            'category_id'   =>'requies|integer|exists:categories,id',
            'slug'          =>'nullable|string|max:40|unique:products,slug',
            'description'   =>'nullable|string'
        ];
    }
}
