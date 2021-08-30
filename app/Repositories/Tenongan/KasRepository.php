<?php
namespace App\Repositories\Tenongan;

use App\Contracts\Tenongan\KasRepository as KasRepositoryContract;
use App\Models\Tenongan\Kas;
use App\Models\Tenongan\Produsen;

/**
 * kas Repositry with eloquent
 * mengatur kas + log kas
 */
class KasRepository implements KasRepositoryContract
{
    public function increase(Kas $kas,array $attribute):void
    {
        $test = Produsen::find(3)->first();
        dd($test->load('logKas'));
        $kas->increment('kas', $attribute['jumlah']);
        $kas->save();
        $kas->logKas()->create($attribute);
    }

    public function decrease(Kas $kas,array $attribute):void
    {
        # code...
        $attribute['jumlah'] = -$attribute['jumlah'];
        $kas->increment('kas', $attribute['jumlah']);
        $kas->save();
        $kas->logKas()->create($attribute);
    }
}
