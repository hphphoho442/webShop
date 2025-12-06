<?php

namespace App\Http\Requests\admin\supplier;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class updateRequest extends FormRequest
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
            'contact'=>('nullable|string|max:150'),
            'name'=>('nullable|string|max:150'),
            'phone'=>[('nullable|string|max:150'),
                        Rule::unique('supplier', 'phone')->
                        ignore($this->id)],
            'email'=>[('nullable|email|max:150'),
                    Rule::unique('supplier', 'email')->
                    ignore($this->id)],
            'address'=>('nullable|string|max:150'),
        ];
    }
}
