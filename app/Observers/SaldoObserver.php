<?php

namespace App\Observers;

use App\Models\Tenongan\Saldo;

class SaldoObserver
{
    /**
     * Handle the Saldo "created" event.
     *
     * @param  \App\Models\Saldo  $saldo
     * @return void
     */
    public function created(Saldo $saldo)
    {
        //
    }

    /**
     * Handle the Saldo "updated" event.
     *
     * @param  \App\Models\Saldo  $saldo
     * @return void
     */
    public function updated(Saldo $saldo)
    {
        //

    }

    /**
     * Handle the Saldo "deleted" event.
     *
     * @param  \App\Models\Saldo  $saldo
     * @return void
     */
    public function deleted(Saldo $saldo)
    {
        //
    }

    /**
     * Handle the Saldo "restored" event.
     *
     * @param  \App\Models\Saldo  $saldo
     * @return void
     */
    public function restored(Saldo $saldo)
    {
        //
    }

    /**
     * Handle the Saldo "force deleted" event.
     *
     * @param  \App\Models\Saldo  $saldo
     * @return void
     */
    public function forceDeleted(Saldo $saldo)
    {
        //
    }
}
