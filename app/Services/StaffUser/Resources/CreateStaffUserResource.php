<?php

declare(strict_types=1);

namespace App\Services\StaffUser\Resources;

use App\Enums\UserTypesEnum;
use App\Models\Role;
use Spatie\DataTransferObject\DataTransferObject;

final class CreateStaffUserResource extends DataTransferObject
{
    public string $email;

    public string $firstName;

    public string $lastName;

    public ?string $middleName = null;

    public ?string $password = null;

    public int $roleId;

    public ?Role $role = null;

    public UserTypesEnum $userTypesEnum;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string|null
     */
    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->roleId;
    }

    /**
     * @return Role|null
     */
    public function getRole(): ?Role
    {
        return $this->role;
    }

    /**
     * @return UserTypesEnum
     */
    public function getUserTypesEnum(): UserTypesEnum
    {
        return $this->userTypesEnum;
    }

    /**
     * @param string $email
     * @return CreateStaffUserResource
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $firstName
     * @return CreateStaffUserResource
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @param string $lastName
     * @return CreateStaffUserResource
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @param string|null $middleName
     * @return CreateStaffUserResource
     */
    public function setMiddleName(?string $middleName): self
    {
        $this->middleName = $middleName;
        return $this;
    }

    /**
     * @param string $password
     * @return CreateStaffUserResource
     */
    public function setPassword(?string $password = null): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param int $roleId
     * @return CreateStaffUserResource
     */
    public function setRoleId(int $roleId): self
    {
        $this->roleId = $roleId;
        return $this;
    }


    /**
     * @param Role|null $role
     * @return CreateStaffUserResource
     */
    public function setRole(?Role $role = null): self
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @param UserTypesEnum $userTypesEnum
     * @return CreateStaffUserResource
     */
    public function setUserTypesEnum(UserTypesEnum $userTypesEnum): self
    {
        $this->userTypesEnum = $userTypesEnum;
        return $this;
    }
}
