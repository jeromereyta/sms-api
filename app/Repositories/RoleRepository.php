<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;

final class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function __construct(Role $role)
    {
        parent::__construct($role);
    }
}
