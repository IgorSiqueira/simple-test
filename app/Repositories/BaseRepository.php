<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Model
    {
      return $this->model->create($data);
    }

    public function updateById(int $modelId,array $data): void{
        $this->model->whereId($modelId)->update($data);
    }

}