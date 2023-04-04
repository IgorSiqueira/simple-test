<?php

namespace App\Repositories;

use App\Models\Custumer;
use App\Repositories\Interfaces\CustumerInterface;

class CustumerRepository extends BaseRepository implements CustumerInterface
{
  protected $model;

  public function __construct(Custumer $model) {
    $this->model = $model;
  }
}
