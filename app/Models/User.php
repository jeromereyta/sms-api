<?php

namespace App\Models;

use App\Enums\UserStatusesEnum;
use App\Enums\UserTypesEnum;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

final class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'email_verified_at',
        'password',
        'status',
        'user_type',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'user_type' => UserTypesEnum::class,
        'status' => UserStatusesEnum::class,
    ];

    public function getEmail(): string
    {
        return $this->getAttribute('email');
    }

    public function getEmailVerifiedAt(): ?string
    {
        return $this->getAttribute('email_verified_at');
    }

    public function getFirstName(): string
    {
        return $this->getAttribute('first_name');
    }

    public function getLastName(): string
    {
        return $this->getAttribute('last_name');
    }

    public function getMiddleName(): ?string
    {
        return $this->getAttribute('middle_name');
    }

    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function getStatus(): UserStatusesEnum
    {
        return $this->getAttribute('status');
    }

    public function getUserType(): UserTypesEnum
    {
        return $this->getAttribute('user_type');
    }

    public function setEmail(string $email): self
    {
        $this->setAttribute('email', $email);

        return $this;
    }

    public function setEmailVerifiedAt(Carbon $emailVerifiedAt): self
    {
        $this->setAttribute('email_verified_at', $emailVerifiedAt);

        return $this;
    }

    public function setFirstName(string $firstName): self
    {
        $this->setAttribute('first_name', $firstName);

        return $this;
    }

    public function setLastName(string $lastName): self
    {
        $this->setAttribute('last_name', $lastName);

        return $this;
    }

    public function setMiddleName(?string $middleName = null): self
    {
        $this->setAttribute('middle_name', $middleName);

        return $this;
    }

    public function setStatus(UserStatusesEnum $statusEnum): self
    {
        $this->setAttribute('status', $statusEnum->getValue());

        return $this;
    }

    public function setUserType(UserTypesEnum $userTypesEnum): self
    {
        $this->setAttribute('user_type', $userTypesEnum->getValue());

        return $this;
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
