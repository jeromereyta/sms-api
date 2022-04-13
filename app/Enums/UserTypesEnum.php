<?php

declare(strict_types=1);

namespace App\Enums;

enum UserTypesEnum: string
{
    case SchoolAdmin = 'school admin';

    case Student = 'student';

    public function getValue(): string
    {
        return $this->value;
    }
}
