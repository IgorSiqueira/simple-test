<?php

namespace App\Repositories\Interfaces;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

interface CovenantInterface extends BaseRepositoryInterface
{
    public function getCovenantGenerateDebit(Carbon $date):Collection;
}