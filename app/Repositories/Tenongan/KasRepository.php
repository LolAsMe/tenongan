<?php
namespace App\Repositories\Tenongan;

use App\Contracts\Tenongan\KasRepository as KasRepositoryContract;
use App\Models\Tenongan\Kas;
use App\Models\Tenongan\LogKas;
use App\Models\Tenongan\Pedagang;
use App\Models\Tenongan\Produk;
use Illuminate\Database\Eloquent\Model;

/**
 * kas Repositry with eloquent
 * mengatur kas + log kas
 */
class KasRepository implements KasRepositoryContract
{
    protected $kas;
    protected $logKas;
    protected $logAttribute;
    protected $payer;

    public function __construct($id=1) {
        $this->kas = Kas::find($id)->load('log');
        $this->setLogAttribute();
    }

    public function setPayer(Model $payer)
    {
        $this->payer = $payer;
    }

    public function findPayer($attribute)
    {
        if (isset($attribute['type']) && isset($attribute['payer_id'])) {
            $attribute['type']=='Pedagang'? $payer = Pedagang::find($attribute['payer_id']):'';
            $attribute['type']=='Produk'? $payer =  Produk::find($attribute['payer_id']):'';
            isset($payer) ? $this->setPayer($payer) : '';
            return $this;
        }
    }

    public function setKas(Kas $kas)
    {
        $this->kas = $kas;
        return $this;
    }

    public function getKas()
    {
        return $this->kas;
    }

    public function setLogKas(LogKas $logKas)
    {
        $this->kas = $logKas;
        return $this;
    }

    public function getLogKas()
    {
        return $this->kas;
    }

    public function setLogAttribute($attribute=[])
    {
        $this->logAttribute['tanggal'] = $attribute['tanggal'] ?? now();
        $this->logAttribute['jumlah'] = $attribute['jumlah'] ?? 0;
        $this->logAttribute['status'] = $attribute['status'] ?? 'Ok';
        $this->logAttribute['keterangan'] = $attribute['keterangan'] ?? '-';
    }

    public function setLogJumlah(mixed $jumlah)
    {
        $this->logAttribute['jumlah'] = $jumlah;

    }

    public function createLog($attribute)
    {
        $this->setLogAttribute($attribute);
        $log = $this->kas->log()->create($this->logAttribute);
        $this->payer ? $log->payer()->associate($this->payer) : null;
        $log->save();
        $this->setLogKas($log);
        return $this;

    }

    public function increase(?array $attribute)
    {
        $this->kas->increment('jumlah', $attribute['jumlah']);
        $this->kas->save();
        $this->createLog($attribute);
        return $this;
    }

    public function decrease(?array $attribute)
    {
        $attribute['jumlah'] = -$attribute['jumlah'];
        $this->increase($attribute);
        return $this;
    }
}
