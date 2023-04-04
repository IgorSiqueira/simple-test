<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Interfaces\ImportFileInterface;
use App\Repositories\Interfaces\CovenantInterface;
use App\Repositories\Interfaces\DebitInterface;

use App\Repositories\ImportFileRepository;
use App\Repositories\CovenantRepository;
use App\Repositories\CustumerRepository;
use App\Repositories\DebitRepository;
use App\Repositories\Interfaces\CustumerInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ImportFileInterface::class, ImportFileRepository::class);
        $this->app->bind(CovenantInterface::class, CovenantRepository::class);
        $this->app->bind(DebitInterface::class, DebitRepository::class);
        $this->app->bind(CustumerInterface::class, CustumerRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
