<?php

namespace App\Models\Tenongan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class KasHarian extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'kas_harian';
    protected $guarded = [];

    public function payer()
    {
        return $this->morphTo();
    }

    /**
     * Get the logKas that owns the KasHarian
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function logKas(): BelongsTo
    {
        return $this->belongsTo(LogKas::class);
    }
}
