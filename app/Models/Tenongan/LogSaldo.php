<?php

namespace App\Models\Tenongan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogSaldo extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'log_saldo';
    protected $guarded = [];

    /**
     * Get the saldo that owns the LogSaldo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function saldo(): BelongsTo
    {
        return $this->belongsTo(Saldo::class);
    }

}
