<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enums\UserTypesEnum;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\StaffUser\Resources\CreateStaffUserResource;
use Illuminate\Database\Eloquent\Collection;

final class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function deleteByStaffIds(array $ids): void
    {
        $this->model->whereIn('id', $ids)->whereUserType(UserTypesEnum::SchoolAdmin)->delete();
    }

    public function findAllSchoolAdmin(): Collection
    {
        return $this->model->where('user_type', UserTypesEnum::SchoolAdmin)->get();
    }

    public function findByEmail(string $email): ?User
    {
        /** @var User $user */
        $user = $this->model->where('email', '=', $email)->first();

        return $user;
    }

    public function findStaff(int $id): ?User
    {
        /** @var User $user */
        $user = $this->model->where('id', $id)->whereUserType(UserTypesEnum::SchoolAdmin)->first();

        return $user;
    }

    public function findByStaffIds(array $ids): Collection
    {
        return $this->model->whereIn('id', $ids)->whereUserType(UserTypesEnum::SchoolAdmin)->get();
    }

    public function updateStaff(User $user, CreateStaffUserResource $resource): User
    {
        $user->setFirstName($resource->getFirstName())
            ->setMiddleName($resource->getMiddleName())
            ->setLastName($resource->getLastName())
            ->setEmail($resource->getEmail());

        $user->roles()->detach();

        $user->roles()->attach($resource->getRole());

        $user->save();

        return $user;
    }
}
