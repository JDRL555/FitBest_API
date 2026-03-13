<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoutineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'description' => $this->description,
            'current_routine' => $this->current_routine,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'exercises' => $this->whenLoaded('exercises', function () {
                return $this->exercises->groupBy('id')->map(function ($group) {
                    $exercise = $group->first();
                    return [
                        'id' => $exercise->id,
                        'name' => $exercise->name,
                        'description' => $exercise->description,
                        'category' => $exercise->category,
                        'equipment_type' => $exercise->equipment_type,
                        'image_reference_url' => $exercise->image_reference_url,
                        'days' => $group->pluck('pivot.day')->unique()->values(),
                    ];
                })->values();
            }),
        ];
    }
}
