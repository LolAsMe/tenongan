<?php

namespace App\Models\Tenongan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kas extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'kas';
    protected $guarded = [];

    /**
     * Get all of the logKas for the Kas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logKas(): HasMany
    {
        return $this->hasMany(LogKas::class);
    }

}
