<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\AdminUser;

use App\Http\Controllers\API\AbstractApiController;
use App\Http\Requests\API\AdminUser\ArchiveStaffsRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Resources\Json\JsonResource;

final class ArchiveStaffsController extends AbstractApiController
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        parent::__construct();
    }

    public function __invoke(ArchiveStaffsRequest $request): JsonResource
    {
        $users = $this->userRepository->findByStaffIds($request->getUserIds());

        if (count($users) !== count($request->getUserIds())) {
            return $this->respondBadRequest([
                'message' => 'Has invalid id',
            ]);
        }
        try {
            $this->userRepository->deleteByStaffIds($request->getUserIds());

            return $this->respondNoContent();
        } catch (\Throwable $throwable) {
            return $this->respondInternalError([
                'message' => $throwable->getMessage(),
                'code' => $throwable->getCode(),
            ]);
        }
    }
}
