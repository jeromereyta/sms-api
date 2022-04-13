<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\AdminUser;

use App\Enums\UserTypesEnum;
use App\Http\Controllers\API\AbstractApiController;
use App\Http\Requests\API\AdminUser\EditStaffUserRequest;
use App\Http\Resources\API\AdminUser\UserResource;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\StaffUser\Resources\CreateStaffUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

final class EditStaffUserController extends AbstractApiController
{
    private UserRepositoryInterface $userRepository;

    private RoleRepositoryInterface $roleRepository;

    public function __construct(
        RoleRepositoryInterface $roleRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;

        parent::__construct();
    }

    public function __invoke(int $id, EditStaffUserRequest $request): JsonResource
    {
        /** @var User $user */
        $user = $this->userRepository->findStaff($id);

        if ($user === null) {
            return $this->respondNotFound([
                'message' => 'Not Found.',
            ]);
        }

        /** @var Role $role */
        $role = $this->roleRepository->find($request->getRoleId());

        try {
            $user = $this->userRepository->updateStaff($user, new CreateStaffUserResource([
                'firstName' => $request->getFirstName() ?? $user->getFirstName(),
                'middleName' => $request->getMiddleName() ?? $user->getMiddleName(),
                'lastName' => $request->getLastName() ?? $user->getLastName(),
                'email' => $request->getEmail() ?? $user->getEmail(),
                'roleId' => $request->getRoleId() ?? $user->getRoles()->first()->getId(),
                'userTypesEnum' => UserTypesEnum::SchoolAdmin,
                'role' => $role,
            ]));

            return new UserResource($user);
        } catch (\Throwable $throwable) {
            return $this->respondInternalError([
                'message' => $throwable->getMessage(),
                'code' => $throwable->getCode(),
            ]);
        }

    }

}
