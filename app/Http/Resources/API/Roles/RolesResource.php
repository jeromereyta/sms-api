<?php

declare(strict_types=1);

namespace App\Http\Resources\API\Roles;

use App\Http\Resources\Resource;

final class RolesResource extends Resource
{
    protected function getResponse(): array
    {
        $roles = [];

        foreach ($this->resource as $role) {
            $roles[] = new RoleResource($role);
        }

        return $roles;
    }
}
