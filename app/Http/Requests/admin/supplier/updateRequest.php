<?php

namespace App\Http\Requests\Admin\Supplier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Để test tạm cho true. Khi deploy, đổi lại kiểm quyền:
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public function rules(): array
    {
        // Lấy id từ route: hỗ trợ cả route model binding (category model) hoặc {id}
        $routeSupplier = $this->route('supplier'); // nếu bạn dùng model binding
        $routeId = $this->route('id');             // nếu bạn dùng {id}

        $ignoreId = null;
        if ($routeSupplier) {
            $ignoreId = is_object($routeSupplier) && method_exists($routeSupplier, 'getKey')
                ? $routeSupplier->getKey()
                : $routeSupplier;
        } elseif ($routeId) {
            $ignoreId = $routeId;
        }

        return [
            'contact' => ['nullable', 'string', 'max:150'],
            'name'    => ['nullable', 'string', 'max:150'],

            'phone' => array_filter([
                'nullable',
                'string',
                'max:150',
                $ignoreId ? Rule::unique('suppliers', 'phone')->ignore($ignoreId) : Rule::unique('suppliers', 'phone'),
            ]),

            'email' => array_filter([
                'nullable',
                'email',
                'max:150',
                $ignoreId ? Rule::unique('suppliers', 'email')->ignore($ignoreId) : Rule::unique('suppliers', 'email'),
            ]),

            'address' => ['nullable', 'string', 'max:150'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.unique' => 'Số điện thoại đã tồn tại.',
            'email.unique' => 'Email đã tồn tại.',
            'name.max'     => 'Tên không quá 150 ký tự.',
        ];
    }
}
