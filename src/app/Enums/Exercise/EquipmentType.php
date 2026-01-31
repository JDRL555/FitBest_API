<?php

namespace App\Enums\Exercise;

enum EquipmentType
{
    case BAR = 'bar';
    case DUMBELL = 'dumbell';
    case MACHINE = 'machine';
    case CABLE = 'cable';
    case BODYWEIGHT = 'bodyweight';
    case OTHER = 'other';
}
