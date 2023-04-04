<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportFile extends Model
{
    use HasFactory;

    protected $table = 'import_files';
    protected $fillable = ['file_path','job_status_id'];

}
