<?php

declare(strict_types=1);

namespace App\Http\Resources\API\Roles;

use App\Exceptions\InvalidResourceTypeException;
use App\Http\Resources\Resource;
use App\Models\Role;
use App\Models\User;

final class RoleResource extends Resource
{
    /**
     * @throws InvalidResourceTypeException
     */
    protected function getResponse(): array
    {
        if (($this->resource instanceof Role) === false) {
            throw new InvalidResourceTypeException(
                Role::class,
                \get_class($this->resource)
            );
        }

        /** @var Role $role */
        $role = $this->resource;

        return [
            'id' => $role->getId(),
            'name' => $role->getName(),
//            'permissions' => $role->getPermissions(),
        ];
    }
}
