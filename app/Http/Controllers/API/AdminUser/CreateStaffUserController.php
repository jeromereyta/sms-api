<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\AdminUser;

use App\Enums\UserTypesEnum;
use App\Http\Controllers\API\AbstractApiController;
use App\Http\Requests\API\AdminUser\CreateStaffUserRequest;
use App\Services\StaffUser\Interfaces\StaffUserFactoryInterface;
use App\Services\StaffUser\Resources\CreateStaffUserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\API\AdminUser\UserResource;

final class CreateStaffUserController extends AbstractApiController
{
    private StaffUserFactoryInterface $factory;

    public function __construct(StaffUserFactoryInterface $factory)
    {
        $this->factory = $factory;
        parent::__construct();
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __invoke(CreateStaffUserRequest $request): JsonResource
    {
        $user = $this->factory->make(new CreateStaffUserResource([
            'firstName' => $request->getFirstName(),
            'middleName' => $request->getMiddleName(),
            'lastName' => $request->getLastName(),
            'email' => $request->getEmail(),
            'password' => $request->getPassword(),
            'userTypesEnum' => UserTypesEnum::SchoolAdmin,
            'roleId' => $request->getRoleId(),
        ]));

        return new UserResource($user);
    }
}
