<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;


use App\Services\Interfaces\FileUploadInterface;
use App\Services\FileUploadService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(FileUploadInterface::class, FileUploadService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
