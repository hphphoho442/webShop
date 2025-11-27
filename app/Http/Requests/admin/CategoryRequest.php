<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true; // cho phép tất cả user gửi request này
    }

    public function rules()
    {
        return [
            'name'        => 'required|max:150',
            'slug'        => 'required|unique:categories,slug|max:191',
            'description' => 'nullable',
            'parent_id'   => 'nullable|exists:categories,id',
            'is_active'   => 'boolean',
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

