<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function create(array $data):Model;
    public function updateById(int $modelId,array $data): void;
    // public function search(array $where = [], array $columnFilters = [], int $limit = 50, int $paginate = 0);
    // public function find(array $condition):Model;
    // public function update(int $id, array $data):Model;
    // public function delete($id):void;
}