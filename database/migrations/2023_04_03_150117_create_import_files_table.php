<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {   
        //'file_path','job_status_id'
        Schema::create('import_files', function (Blueprint $table) {
            $table->id();
            $table->string('file_path',200);
            $table->foreignId('job_status_id')->constrained('job_statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_files');
    }
};
