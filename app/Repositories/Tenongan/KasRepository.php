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
    public function increase(Kas $kas,array $attribute,Model $payer)
    {
        $kas->increment('jumlah', $attribute['jumlah']);
        $kas->save();
        $attribute['tanggal'] = now();
        $attribute['status'] = 'Ok';
        $log = $kas->log()->create($attribute);
        $log->payer()->associate($payer);
        $log->save();
    }

    public function decrease(Kas $kas,array $attribute)
    {
        # code...
        $attribute['jumlah'] = -$attribute['jumlah'];
        $kas->increment('jumlah', $attribute['jumlah']);
        $kas->save();
        $attribute['status'] = 'Ok';
        $attribute['tanggal'] = now();
        $kas->log()->create($attribute);
    }
}
