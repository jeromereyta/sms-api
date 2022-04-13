<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function delete(Model $model): void
    {
        $model->delete();
    }

    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    public function findAll(): Collection
    {
        return $this->model->where('name', '!=', 'Student')->get();
    }
}
