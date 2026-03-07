<?php

namespace App\Http\Requests\Routine;

use Illuminate\Foundation\Http\FormRequest;

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
            'user_id' => 'required|integer|exists:users,id',
            'name' => 'required|string|max:50|min:3',
            'description' => 'nullable|string|max:100|min:10',
            'current_routine' => 'nullable|boolean|default:false'
        ];
    }
}
