<?php

namespace App\Enums;

enum Category
{
    case PUSH = 'push';
    case PULL = 'pull';
    case LEGS = 'legs';
    case CORE = 'core';
}
