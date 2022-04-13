<?php

declare(strict_types=1);

namespace App\Http\Requests\API\AdminUser;

use App\Enums\UserTypesEnum;
use App\Http\Requests\BaseRequest;

final class CreateStaffUserRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function getFirstName(): string
    {
        return $this->getString('first_name');
    }

    public function getMiddleName(): string
    {
        return $this->getString('middle_name');
    }

    public function getLastName(): string
    {
        return $this->getString('last_name');
    }

    public function getEmail(): string
    {
        return $this->getString('email');
    }

    public function getPassword(): string
    {
        return $this->getString('password');
    }

    public function getRoleId(): int
    {
        return $this->getInt('role_id');
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|unique:App\Models\User,email',
            'password' => 'required|string',
            'password_confirmation' => 'required|string|min:6',
            'role_id' => 'int|required|exists:App\Models\Role,id',
        ];
    }
}
