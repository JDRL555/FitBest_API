<?php

namespace App\Http\Requests\Sets;

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
                'workout_id' => 'required|integer|exists:workouts,id',
                'exercise_id' => 'required|integer|exists:exercises,id',
                'reps' => 'required|integer|min:1',
                'sets' => 'required|integer|min:1|max:6',
                'weight_count' => 'nullable|numeric|min:1',
                'weight_type' => 'nullable|in:kg,bars',
            ];
        }

        return [
            'workout_id' => 'nullable|integer|exists:workouts,id',
            'exercise_id' => 'nullable|integer|exists:exercises,id',
            'reps' => 'nullable|integer|min:1',
            'sets' => 'nullable|integer|min:1|max:6',
            'weight_count' => 'nullable|numeric|min:1',
            'weight_type' => 'nullable|in:kg,bars',
        ];
    }
}
