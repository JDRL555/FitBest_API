<?php

namespace App\Models;

// Enums
use App\Enums\Exercise\Category;
use App\Enums\Exercise\EquipmentType;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Exercise extends Model
{
  // optional: overwrite the $table property to indicate which table it has to be related to
  protected $table = "exercises";

  // fields that can't be manipulated in the app
  // if this array is empty, all fields are mass assignable (fillable prop)
  protected $guarded = [];


  // conversion of fields with some stricted type
  protected function casts(): array 
  {
    return [
      'category' => Category::class,
      'equipment_type' => EquipmentType::class,
    ];
  }

  public function routines(): BelongsToMany
  {
      return $this->belongsToMany(Routine::class, 'routines_exercises')
                  ->withTimestamps();
  }
}
