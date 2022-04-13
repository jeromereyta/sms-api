<?php

declare(strict_types=1);

namespace App\Http\Requests\API\AdminUser;

use App\Http\Requests\BaseRequest;

final class EditStaffUserRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function getFirstName(): ?string
    {
        return $this->getString('first_name');
    }

    public function getMiddleName(): ?string
    {
        return $this->getString('middle_name');
    }

    public function getLastName(): ?string
    {
        return $this->getString('last_name');
    }

    public function getEmail(): ?string
    {
        return $this->getString('email');
    }

    public function getPassword(): ?string
    {
        return $this->getString('password');
    }

    public function getRoleId(): ?int
    {
        return $this->getInt('role_id');
    }

    public function rules(): array
    {
        return [
            'first_name' => 'string',
            'middle_name' => 'string',
            'last_name' => 'string',
            'email' => 'string',
            'role_id' => 'int|required|exists:App\Models\Role,id',
        ];
    }
}
