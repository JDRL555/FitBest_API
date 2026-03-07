<?php

namespace App\Enums\Exercise;

enum Category: string
{
    case PUSH = 'push';
    case PULL = 'pull';
    case LEGS = 'legs';
    case CORE = 'core';
}
