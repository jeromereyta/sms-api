<?php

declare(strict_types=1);

namespace App\Http\Resources\API\AdminUser;

use App\Http\Resources\Resource;

final class UsersResource extends Resource
{
    protected function getResponse(): array
    {
        $users = [];

        foreach ($this->resource as $role) {
            $users[] = new UserResource($role);
        }

        return $users;
    }
}
