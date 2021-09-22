<?php

namespace App\Models\Tenongan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Tenongan\LogKas
 *
 * @property int $id
 * @property int $kas_id
 * @property string $kode
 * @property string $jumlah
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $payer_type
 * @property int|null $payer_id
 * @property string|null $keterangan
 * @property-read \App\Models\Tenongan\Kas $kas
 * @property-read Model|\Eloquent $payer
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas newQuery()
 * @method static \Illuminate\Database\Query\Builder|LogKas onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas query()
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas whereKasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas wherePayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas wherePayerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|LogKas withTrashed()
 * @method static \Illuminate\Database\Query\Builder|LogKas withoutTrashed()
 * @mixin \Eloquent
 * @property string $tanggal
 * @property string $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tenongan\KasHarian[] $kasHarian
 * @property-read int|null $kas_harian_count
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogKas whereTanggal($value)
 */
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
        return $this->morphTo();
    }

    public function getPayerTypeAttribute($value)
    {
        $newValue =  substr($value, strpos($value, "n\\")+2);
        return $newValue;
    }

    /**
     * Get all of the kasHarian for the LogKas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kasHarian(): HasMany
    {
        return $this->hasMany(KasHarian::class);
    }
}
