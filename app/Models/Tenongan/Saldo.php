<?php

namespace App\Models\Tenongan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Saldo extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'saldo';
    protected $guarded = [];

    /**
     * Get all of the logSaldo for the Saldo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logSaldo(): HasMany
    {
        return $this->hasMany(LogSaldo::class);
    }
}
