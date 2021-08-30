<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Tenongan\SaldoRepository as SaldoRepositoryContract;
use App\Repositories\Tenongan\SaldoRepository;

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
