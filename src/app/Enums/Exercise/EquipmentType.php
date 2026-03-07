<?php

namespace App\Enums\Exercise;

enum EquipmentType: string
{
    case BAR = 'bar';
    case DUMBBELL = 'dumbbell';
    case MACHINE = 'machine';
    case CABLE = 'cable';
    case BODYWEIGHT = 'bodyweight';
    case OTHER = 'other';
}
