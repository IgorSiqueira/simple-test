<?php

namespace App\Console\Commands;

use App\Models\Covenant;
use App\Models\Debit;
use App\Repositories\Interfaces\CovenantInterface;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DebitGenerate extends Command
{
    private $covenantRepository;
    private $debit = [];
    public function __construct(CovenantInterface $covenantRepository){
        parent::__construct();
        $this->covenantRepository = $covenantRepository;
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:debit-generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Obtem os contratos que não tem débito gerado para geração';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $now = Carbon::now();
        $nowFormated = $now->format('Y-m-d H:i:s');
        $allCovenantwithCustumer = $this->covenantRepository->getCovenantGenerateDebit($now);
        $allCovenantwithCustumer->each(function (Covenant $covenantCustumer, int $key) use ($nowFormated){
            $debit = ['covenant_id'=>$covenantCustumer->id,'created_at'=>$nowFormated,'updated_at'=>$nowFormated];
            array_push($this->debit,$debit);

            //Serviço de Geração de Boleto que retornar uma urlS3 por exemplo;
            //Job que Envia com Email com Url do Arquivo;

        });
        Debit::insert($this->debit); // Eloquent approach
    }
}
