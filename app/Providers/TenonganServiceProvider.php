<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Tenongan\TenonganService as TenonganServiceContract;
use App\Services\Tenongan\TenonganService;
use Illuminate\Database\Eloquent\Relations\Relation;

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
        Relation::morphMap([
            'Admin' => 'App\Models\Tenongan\Admin',
            'DetailTransaksi' => 'App\Models\Tenongan\DetailTransaksi',
            'Kas' => 'App\Models\Tenongan\Kas',
            'KasHarian' => 'App\Models\Tenongan\KasHarian',
            'LogKas' => 'App\Models\Tenongan\LogKas',
            'LogSaldo' => 'App\Models\Tenongan\LogSaldo',
            'Pedagang' => 'App\Models\Tenongan\Pedagang',
            'Penjualan' => 'App\Models\Tenongan\Penjualan',
            'PenjualanTransaksi' => 'App\Models\Tenongan\PenjualanTransaksi',
            'Produk' => 'App\Models\Tenongan\Produk',
            'Produsen' => 'App\Models\Tenongan\Produsen',
            'Rutinitas' => 'App\Models\Tenongan\Rutinitas',
            'Saldo' => 'App\Models\Tenongan\Saldo',
            'Transaksi' => 'App\Models\Tenongan\Transaksi',
            'User' => 'App\Models\User',
        ]);
    }
}
