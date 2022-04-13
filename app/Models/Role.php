<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Role extends Model
{
    protected $table = 'roles';

    public function getId(): int
    {
        return (int) $this->getAttribute('id');
    }

    public function getName(): string
    {
        return $this->getAttribute('name');
    }

    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }
}
