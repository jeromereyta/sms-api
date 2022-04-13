<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\AdminUser;

use App\Http\Controllers\API\AbstractApiController;
use App\Http\Resources\API\AdminUser\UsersResource;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Resources\Json\JsonResource;

final class UserListController extends AbstractApiController
{
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        parent::__construct();
    }

    public function __invoke(): JsonResource
    {
        $users = $this->userRepository->findAllSchoolAdmin();

        return new UsersResource($users);
    }
}
