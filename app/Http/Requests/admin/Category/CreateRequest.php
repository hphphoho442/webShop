<?php

namespace App\Http\Requests\admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public function rules()
    {
        return [
            'name'        => 'required|max:150',
            'slug'        => 'required|unique:categories,slug|max:191',
            'description' => 'nullable',
            'parent_id'   => 'nullable|exists:categories,id',
            // 'is_active'   => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên category là bắt buộc',
            'slug.required' => 'Slug là bắt buộc',
            'slug.unique'   => 'Slug đã tồn tại',
            'parent_id.exists' => 'Danh mục cha không hợp lệ',
        ];
    }
}
