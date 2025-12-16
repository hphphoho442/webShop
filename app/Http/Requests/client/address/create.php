<?php

namespace App\Http\Requests\client\address;

use Illuminate\Foundation\Http\FormRequest;

class create extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return ['label'     => 'required|string|max:100',
                'recipient' => 'required|string|max:150',
                'phone'     => 'required|string|max:20',
                'line'      => 'required|string|max:255',
                'ward'      => 'required|string|max:100',
                'district'  => 'required|string|max:100',
                'province'  => 'required|string|max:100',
        ];
    }
}
