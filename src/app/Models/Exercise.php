<?php

namespace App\Models;

// Enums
use App\Enums\Exercise\Category;
use App\Enums\Exercise\EquipmentType;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Uri;

class Exercise extends Model
{
  // optional: overwrite the $table property to indicate which table it has to be related to
  protected $table = "exercises";

  // fields that can be manipulated in the app
  protected $fillable = [
    'name', 
    'description', 
    'category', 
    'equipment_type', 
    'image_reference_url'  
  ];


  // conversion of fields with some stricted type
  protected function casts(): array 
  {
    return [
      'category' => Category::class,
      'equipment_type' => EquipmentType::class,
    ];
  }
}
