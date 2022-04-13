<?php

declare(strict_types=1);

namespace App\Http\Resources\API\Authentication;

use App\Exceptions\InvalidResourceTypeException;
use App\Http\Resources\Resource;
use App\Models\User;

final class LoginResource extends Resource
{
    /**
     * @throws InvalidResourceTypeException
     */
    protected function getResponse(): array
    {
        if (($this->resource instanceof User) === false) {
            throw new InvalidResourceTypeException(
                User::class,
                \get_class($this->resource)
            );
        }

        /** @var User $user */
        $user = $this->resource;

        return [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'first_name' => $user->getFirstName(),
            'middle_name' => $user->getMiddleName(),
            'last_name' => $user->getLastName(),
            'user_type' => $user->getUserType()->getValue(),
        ];
    }
}
