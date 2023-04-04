<?php

namespace App\Repositories;

use App\Models\Covenant;
use App\Models\ImportFile;
use App\Repositories\Interfaces\CovenantInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class CovenantRepository extends BaseRepository implements CovenantInterface
{
  protected $model;

  public function __construct(Covenant $model) {
    $this->model = $model;
  }

  public function getCovenantGenerateDebit(Carbon $date):Collection{
    return $this->model->select('id','custumer_id')->doesntHave('debit')->where('debt_due_date',$date->format('Y-m-d'))->with('custumer:id,name,email')->get();
  }
}
