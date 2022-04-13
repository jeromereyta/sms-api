<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Roles;

use App\Http\Controllers\API\AbstractApiController;
use App\Http\Resources\API\Roles\RoleResource;
use App\Http\Resources\API\Roles\RolesResource;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Http\Resources\Json\JsonResource;

final class RoleListController extends AbstractApiController
{
    private RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
        parent::__construct();
    }

    public function __invoke(): JsonResource
    {
        $roles = $this->roleRepository->findAll();

        return new RolesResource($roles);
    }
}
