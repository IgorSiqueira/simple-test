<?php

namespace App\Services\Interfaces;

use Illuminate\Http\UploadedFile;

interface FileUploadInterface
{
    public function setDisk(string $diskName):void;
    public function getDisk():string;
    public function upload(UploadedFile $file,string $storagePath,string|null $nameFile = null):string;
}
