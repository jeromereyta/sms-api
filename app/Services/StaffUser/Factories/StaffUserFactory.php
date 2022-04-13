<?php

declare(strict_types=1);

namespace App\Services\StaffUser\Factories;

use App\Enums\UserStatusesEnum;
use App\Models\User;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\StaffUser\Interfaces\StaffUserFactoryInterface;
use App\Services\StaffUser\Resources\CreateStaffUserResource;
use Illuminate\Contracts\Hashing\Hasher;

final class StaffUserFactory implements StaffUserFactoryInterface
{
    private Hasher $hash;

    private RoleRepositoryInterface $roleRepository;

    private UserRepositoryInterface $userRepository;

    public function __construct(
        Hasher $hash,
        RoleRepositoryInterface $roleRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->hash = $hash;
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
    }

    public function make(CreateStaffUserResource $resource): User
    {
        $role = $this->roleRepository->find($resource->getRoleId());

        /** @var User $user */
        $user = $this->userRepository->create([
            'first_name' => $resource->getFirstName(),
            'middle_name' => $resource->getMiddleName(),
            'last_name' => $resource->getLastName(),
            'status' => UserStatusesEnum::Active,
            'email' => $resource->getEmail(),
            'password' => $this->hash->make($resource->getPassword()),
            'user_type' => $resource->getUserTypesEnum()->getValue(),
        ]);

        $user->roles()->attach($role);

        $user->save();

        return $user;
    }
}
