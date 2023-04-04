<?php

namespace App\Http\Controllers;

use App\Enums\JobStatus;
use App\Repositories\Interfaces\ImportFileInterface;
use App\Services\Interfaces\FileUploadInterface;
use App\Http\Requests\Covenant\Index;
use App\Http\Requests\Covenant\Store;
use App\Jobs\CovenantImport;
use App\Traits\HttpResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CovenantController extends Controller
{ 
    private $fileUpload;
    private $importFileRepository;

    public function __construct(FileUploadInterface $fileUpload,ImportFileInterface $importFileRepository)
    {
        $this->fileUpload = $fileUpload;
        $this->importFileRepository = $importFileRepository;
    }

    /**
     * Import CSV file to generate covenant
     *
     * @param  App\Http\Requests\Covenant\Store  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request):Response
    {
        $fileImport = $request->file;
        $localStorage = 'imports';
        $nameFile = now()->format('d-m-Y h:i:s').Str::random(4);
        $relativePath = $this->fileUpload->upload($fileImport,$localStorage,$nameFile);

        $importFile = ['file_path'=>$relativePath,'job_status_id'=>JobStatus::PROGRESS];
        $importFile = $this->importFileRepository->create($importFile);
        if($importFile){
            CovenantImport::dispatch($importFile,$this->importFileRepository);
        }
        return $this->sendResponse(Response::HTTP_OK);
    }
}
