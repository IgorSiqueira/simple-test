<?php

namespace App\Jobs;

use App\Repositories\Interfaces\DebitInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PaidDebit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $debitRepository;
    private $requestAtributes;
    public $tries = 1;
    /**
     * Create a new job instance.
     */
    public function __construct(DebitInterface $debitRepository,array $requestAtributes)
    {
        $this->debitRepository = $debitRepository;
        $this->requestAtributes = $requestAtributes;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $debitId =  $this->requestAtributes['debit_id'];
        unset($this->requestAtributes['debit_id']);
        $this->debitRepository->updateById($debitId,$this->requestAtributes);
    }
}
