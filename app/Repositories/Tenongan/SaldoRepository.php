<?php
namespace App\Repositories\Tenongan;

use App\Contracts\Tenongan\SaldoRepository as SaldoRepositoryContract;
use Illuminate\Database\Eloquent\Model;

/**
 * Saldo Repositry with eloquent
 * mengatur saldo + log saldo
 */
class SaldoRepository implements SaldoRepositoryContract
{
    public function increase(Model $saldo,int $jumlah):void
    {
        $saldo->increment('jumlah', $jumlah);
        $saldo->save();
        $saldo->logSaldo()->create(["jumlah"=>$jumlah,'tanggal'=>now()]);
    }

    public function decrease(Model $saldo,int $jumlah):void
    {
        $jumlah = -$jumlah;
        $saldo->increment('jumlah', $jumlah);
        $saldo->save();
        $saldo->logSaldo()->create(["jumlah"=>$jumlah,'tanggal'=>now()]);
    }
}
