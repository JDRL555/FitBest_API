<?php

namespace App\Http\Requests\User;

use App\Enums\User\Gender;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateRequest extends FormRequest
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
        if($this->isMethod("PUT")) {
            return [
                'name' => 'required|string|max:50|min:5',
                'username' => 'required|string|max:30|unique:users,username',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'gender' => ['required', new Enum(Gender::class)],
                'birth_date' => 'required|date|before:today',
                'weight_kg' => 'required|numeric',
                'height_m' => 'required|numeric'
            ];
        }
        return [
            'name' => 'nullable|string|max:50|min:5',
            'username' => 'nullable|string|max:30|unique:users,username',
            'email' => 'nullable|email|max:255|unique:users,email',
            'password' => 'nullable|string|min:8|confirmed',
            'gender' => ['nullable', new Enum(Gender::class)],
            'birth_date' => 'nullable|date|before:today',
            'weight_kg' => 'nullable|numeric',
            'height_m' => 'nullable|numeric'
        ];
    }
}
