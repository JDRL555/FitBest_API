<?php

namespace App\Http\Requests\Workout;

use Illuminate\Foundation\Http\FormRequest;

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
                'user_id' => 'required|exists:users,id',
                'routine_id' => 'required|exists:routines,id',
                'start_at' => 'required|date_format:Y-m-d H:i',
                'end_at' => 'required|date_format:Y-m-d H:i|after:start_at',
                'notes' => 'nullable|string'
            ];
        }
        
        return [
            'user_id' => 'nullable|exists:users,id',
            'routine_id' => 'required|exists:routines,id',
            'start_at' => 'nullable|date_format:Y-m-d H:i',
            'end_at' => 'nullable|date_format:Y-m-d H:i|after:start_at',
            'notes' => 'nullable|string'
        ];
    }
}
