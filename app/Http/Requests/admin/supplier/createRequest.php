<?php

namespace App\Http\Requests\admin\supplier;

use Illuminate\Foundation\Http\FormRequest;

class createRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->User()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'contact'=>('required|string|max:150'),
            'name'=>('required|string|max:150'),
            'phoneNumber'=>('required|string|max:150|unique:suppliers,phone'),
            'email'=>('required|email|max:150|unique:suppliers,email'),
            'address'=>('required|string|max:150'),

        ];
    }
}
