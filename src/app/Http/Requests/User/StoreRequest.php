<?php

namespace App\Http\Requests\User;

use App\Enums\User\Gender;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreRequest extends FormRequest
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
}
