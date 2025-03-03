<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'phone' => 'required|string|max:255|unique:leads',
            'address' => 'required|string',
            'password' => 'required|string|min:8',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            '*.required' => 'The :attribute field is required.',
            '*.string' => 'The :attribute must be a string.',
            '*.min' => 'The :attribute must be at least :min characters.',
            '*.max' => 'The :attribute must be at most :max characters.',
            '*.unique' => 'The :attribute has already been taken.',
        ];
    }
}
