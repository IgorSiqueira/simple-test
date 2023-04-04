<?php

namespace App\Repositories;

use App\Models\Debit;
use App\Repositories\Interfaces\DebitInterface;


class DebitRepository extends BaseRepository implements DebitInterface
{
  protected $model;

  public function __construct(Debit $model) {
    $this->model = $model;
  }
}
