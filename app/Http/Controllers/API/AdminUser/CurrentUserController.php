<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\AdminUser;

use App\Http\Controllers\API\AbstractApiController;
use App\Http\Resources\API\AdminUser\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

final class CurrentUserController extends AbstractApiController
{
    public function __invoke(): JsonResource
    {
        return new UserResource($this->getUser());
    }
}
