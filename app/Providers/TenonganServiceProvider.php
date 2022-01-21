<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Tenongan\TenonganService as TenonganServiceContract;
use App\Services\SpreadsheetService;
use App\Services\Tenongan\FileService;
use App\Services\Tenongan\Rutinitas;
use App\Services\Tenongan\TempService;
use App\Services\Tenongan\TenonganService;
use Blade;
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

        $this->app->bind(TenonganServiceContract::class, function($app){
            return new TenonganService(new Rutinitas());
        });
        $this->app->bind(FileService::class, function($app){
            return new FileService();
        });

        $this->app->bind(SpreadsheetService::class, function($app){
            return new SpreadsheetService();
        });
        $this->app->bind(TempService::class, function($app){
            return new TempService(new SpreadsheetService());
        });

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Blade::directive('hello', function ($expression) {
            // dd($expression);
            // return TenonganService::toCurrency();
        });
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
