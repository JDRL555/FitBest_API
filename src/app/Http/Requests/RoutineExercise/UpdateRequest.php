<?php

namespace App\Http\Requests\RoutineExercise;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('PUT')) {
            return [
                'routine_id' => 'required|integer|exists:routines,id',
                'exercise_id' => 'required|integer|exists:exercises,id',
                'day' => 'required|string|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            ];
        }
        return [
            'routine_id' => 'nullable|integer|exists:routines,id',
            'exercise_id' => 'nullable|integer|exists:exercises,id',
            'day' => 'nullable|string|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
        ];
    }
}
