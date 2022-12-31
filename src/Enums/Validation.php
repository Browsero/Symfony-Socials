<?php

namespace App\Enums;

enum Validation: string
{
    case CANNOT_BE_BLANK = 'Field cannot be empty.';
    case MIN_LENGTH_5 = 'Minimum length of input is 5 characters.';
    case MAX_LENGTH_5 = 'Maximum length of input is 500 characters.';
}