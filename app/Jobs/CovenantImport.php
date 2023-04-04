<?php

namespace App\Jobs;

use App\Enums\JobStatus;
use App\Imports\CovenantParse;
use App\Models\ImportFile;
use App\Repositories\Interfaces\ImportFileInterface;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class CovenantImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $importFile;
    private $importFileRepository;
    /**
     * Create a new job instance.
     */
    public function __construct(ImportFile $importFile,ImportFileInterface $importFileRepository)
    {
        $this->importFile = $importFile;
        $this->importFileRepository = $importFileRepository;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $absolutePath =$this->importFile->file_path;
        Excel::import(new CovenantParse,$absolutePath);
        $this->updateStatus(JobStatus::SUCCESS);
    }
    public function failed(Exception $exception){
        $this->updateStatus(JobStatus::FAILED);
    }
    
    private function updateStatus(JobStatus $jobStatus){
        $this->importFileRepository->updateById($this->importFile->id,['job_status_id'=>$jobStatus]);
    }

    

}
