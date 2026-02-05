<?php

namespace App\Http\Requests\Exercise;

use App\Enums\Exercise\Category;
use App\Enums\Exercise\EquipmentType;

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
        return [
            'name' => 'nullable|string|max:50|min:3',
            'description' => 'nullable|string|max:100|min:10',
            'category' => ['nullable', new Enum(Category::class)],
            'equipment_type' => ['nullable', new Enum(EquipmentType::class)],
            'image_reference_url' => 'nullable|url'
        ];
    }
}
