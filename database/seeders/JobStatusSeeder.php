<?php

namespace Database\Seeders;

use App\Models\JobStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobStatus::updateOrCreate([
            'id' => 1
        ],[
            'name' =>'processing',
        ])->save();
        JobStatus::updateOrCreate([
            'id' => 2
        ],[
            'name' =>'success',
        ])->save();
        JobStatus::updateOrCreate([
            'id' => 3
        ],[
            'name' =>'failed',
        ])->save();
    }
}
