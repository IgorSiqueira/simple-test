<?php

namespace App\Repositories;

use App\Models\ImportFile;
use App\Repositories\Interfaces\ImportFileInterface;

class ImportFileRepository extends BaseRepository implements ImportFileInterface
{
  protected $model;

  public function __construct(ImportFile $model) {
    $this->model = $model;
  }
}
