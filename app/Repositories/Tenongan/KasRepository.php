<?php
namespace App\Repositories\Tenongan;

use App\Contracts\Tenongan\KasRepository as KasRepositoryContract;
use App\Models\Tenongan\Kas;
use Illuminate\Database\Eloquent\Model;

/**
 * kas Repositry with eloquent
 * mengatur kas + log kas
 */
class KasRepository implements KasRepositoryContract
{
    public function increase(Kas $kas,array $attribute,Model $payer):void
    {
        $kas->increment('jumlah', $attribute['jumlah']);
        $kas->save();
        $log = $kas->logKas()->create($attribute);
        $log->payer()->associate($payer);
        $log->save();
    }

    public function decrease(Kas $kas,array $attribute):void
    {
        # code...
        $attribute['jumlah'] = -$attribute['jumlah'];
        $attribute['keterangan'] = $attribute['kerangang'];
        $kas->increment('kas', $attribute['jumlah']);
        $kas->save();
        $kas->logKas()->create($attribute);
    }
}
