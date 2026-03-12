<?php

namespace App\Http\Requests\RoutineExercise;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'routine_id' => 'required|integer|exists:routines,id',
            'exercise_id' => 'required|integer|exists:exercises,id',
            'day' => 'required|string|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
        ];
    }
}
