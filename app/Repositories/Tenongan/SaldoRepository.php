<?php
namespace App\Repositories\Tenongan;

use App\Contracts\Tenongan\SaldoRepository as SaldoRepositoryContract;
use App\Models\Tenongan\Saldo;
use Illuminate\Database\Eloquent\Model;

/**
 * Saldo Repositry with eloquent
 * mengatur saldo + log saldo
 */
class SaldoRepository implements SaldoRepositoryContract
{
    protected $saldo;
    protected $logSaldo;
    protected $logSaldoAttribute;

    public function __construct(?Saldo $saldo=null) {
        $this->saldo = $saldo;
    }

    public function setSaldo(?Saldo $saldo)
    {
        $this->saldo = $saldo;
        return $this;
    }

    public function setLogSaldoAttribute($attribute)
    {
        $this->logSaldoAttribute['jumlah'] = $attribute['jumlah'];
        $this->logSaldoAttribute['status'] = $attribute['status'] ?? 'Ok';
        $this->logSaldoAttribute['tanggal'] = $attribute['tanggal'] ?? now();
    }
    public function getLogSaldoAttribute()
    {
        return $this->logSaldoAttribute;
    }

    public function increase(int $jumlah)
    {
        $this->saldo->increment('jumlah', $jumlah);
        $this->saldo->save();
        $this->setLogSaldoAttribute(['jumlah'=>$jumlah]);
        $this->saldo->logSaldo()->create($this->getLogSaldoAttribute());
    }

    public function decrease(int $jumlah)
    {
        $jumlah = -$jumlah;
        $this->increase($jumlah);
    }
}
