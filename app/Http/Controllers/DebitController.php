<?php

namespace App\Http\Controllers;

use App\Http\Requests\Debit\WebHookPaid;
use App\Jobs\PaidDebit;
use App\Repositories\Interfaces\DebitInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DebitController extends Controller
{   

    private $debitRepository;

    public function __construct(DebitInterface $debitRepository)
    {
        $this->debitRepository = $debitRepository;
    }

    public function webHookPaid(WebHookPaid $request){
        PaidDebit::dispatch($this->debitRepository,$request->all())->delay(now()->addMinutes(1));
        return $this->sendResponse(Response::HTTP_OK);
    }
}
