<?php

declare(strict_types=1);

namespace App\Services\StaffUser\Interfaces;

use App\Models\User;
use App\Services\StaffUser\Resources\CreateStaffUserResource;

interface StaffUserFactoryInterface
{
    public function make(CreateStaffUserResource $resource): User;
}
