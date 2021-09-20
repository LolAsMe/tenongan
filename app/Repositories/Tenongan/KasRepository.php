<?php
namespace App\Repositories\Tenongan;

use App\Contracts\Tenongan\KasRepository as KasRepositoryContract;
use App\Models\Tenongan\Kas;
use App\Models\Tenongan\KasHarian;
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
    protected $kasHarian;
    protected $logAttribute;
    protected $kasHarianAttribute;
    protected $payer;

    public function __construct($id=1) {
        $this->kas = Kas::find($id)->load('log');
        $this->setLogAttribute();
    }

    public function setKasHarianAttribute(array $attribute)
    {
        $this->kasHarianAttribute['log_kas_id'] =$attribute['log_kas_id'] ?? null;
        $this->kasHarianAttribute['tanggal'] =$attribute['tanggal'] ?? now();
        $this->kasHarianAttribute['jumlah'] =$attribute['jumlah'];
        $this->kasHarianAttribute['status'] =$attribute['status'] ?? 'Pending';
        $this->kasHarianAttribute['keterangan'] =$attribute['keterangan'] ?? null;
        return $this;
    }

    public function createKasHarian(?array $attribute=null)
    {
        if (isset($attribute)) {
            $this->setKasHarianAttribute($attribute);
            $this->kasHarian = $this->payer->kasHarian()->create($attribute);
        }else{
            $this->kasHarian = $this->payer->kasHarian()->create($attribute);
        }
        return $this;
    }

    public function getKasHarian()
    {
        return $this->kasHarian;
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
        return $this;
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
