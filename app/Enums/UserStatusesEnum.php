<?php

declare(strict_types=1);

namespace App\Enums;

enum UserStatusesEnum: string
{
    case Active = 'active';

    case Inactive = 'inactive';

    case Unverified = 'unverified';

    public function getValue(): string
    {
        return $this->value;
    }
}
