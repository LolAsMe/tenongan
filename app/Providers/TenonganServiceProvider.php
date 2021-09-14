<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Tenongan\SaldoRepository as SaldoRepositoryContract;
use App\Contracts\Tenongan\KasRepository as KasRepositoryContract;
use App\Contracts\Tenongan\TenonganService as TenonganServiceContract;
use App\Repositories\Tenongan\SaldoRepository;
use App\Repositories\Tenongan\KasRepository;
use App\Services\Tenongan\TenonganService;

class TenonganServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(SaldoRepositoryContract::class, SaldoRepository::class);
        $this->app->bind(KasRepositoryContract::class, KasRepository::class);
        $this->app->bind(TenonganServiceContract::class, TenonganService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
