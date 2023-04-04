<?php

namespace App\Services;

use App\Services\Interfaces\FileUploadInterface;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploadService implements FileUploadInterface
{
    private Storage $storage;
    private FilesystemAdapter $bucket;

    private string $disk = 'local';

    public function __construct(Storage $storage)
    {
        $this->storage = new Storage();
        $this->prepareStorage();
    }

    public function setDisk(string $diskName):void
    {
        $this->disk = $diskName;
        $this->prepareStorage();
    }

    public function getDisk():string
    {
        return $this->disk;
    }
    
    private function prepareStorage():void
    {
        $this->bucket =  $this->storage::disk($this->disk);
    }

    public function upload(UploadedFile $file,string $filePath,string|null $nameFile = null):string 
    {
        try {
            $bucket = 
            $originalName = $file->getBasename();
            $originalExtension = $file->getClientOriginalExtension();
            if($nameFile){
                $originalName = $nameFile;
            }
            $nameWithExtension = $originalName.'.'.$originalExtension;
            $savedFile = $this->bucket->put($filePath.'/'.$nameWithExtension, file_get_contents($file));

            if($this->disk <> 'local'){
                return $this->bucket->url($filePath.'/'.$nameWithExtension);
            }
            return $this->bucket->path($filePath.'/'.$nameWithExtension);

        } catch (\Throwable $th) {
           
        }
    }

}