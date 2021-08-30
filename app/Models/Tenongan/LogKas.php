<?php

namespace App\Models\Tenongan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogKas extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'log_kas';
    protected $guarded = [];

    /**
     * Get the kas that owns the LogKas
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kas(): BelongsTo
    {
        return $this->belongsTo(Kas::class);
    }

    public function payer()
    {
        return $this->morphTo('payer');
    }
}
