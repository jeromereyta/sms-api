<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\User;
use App\Services\StaffUser\Resources\CreateStaffUserResource;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function deleteByStaffIds(array $ids): void;

    public function findAllSchoolAdmin(): Collection;

    public function findByEmail(string $email): ?User;

    public function findByStaffIds(array $ids): Collection;

    public function findStaff(int $id): ?User;

    public function updateStaff(User $user, CreateStaffUserResource $resource): User;
}
