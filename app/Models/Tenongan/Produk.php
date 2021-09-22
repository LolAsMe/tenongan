<?php

namespace App\Models\Tenongan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Tenongan\Produk
 *
 * @property int $id
 * @property string $kode
 * @property string $nama
 * @property int|null $produsen_id
 * @property string $harga_jual
 * @property string $harga_beli
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\Tenongan\ProdukFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Produk newQuery()
 * @method static \Illuminate\Database\Query\Builder|Produk onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Produk query()
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereHargaBeli($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereHargaJual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereProdusenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Produk withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Produk withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tenongan\LogKas[] $logKas
 * @property-read int|null $log_kas_count
 * @property-read \App\Models\Tenongan\Produsen|null $produsen
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tenongan\KasHarian[] $kasHarian
 * @property-read int|null $kas_harian_count
 */
class Produk extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'produk';
    protected $guarded = [];

    /**
     * Get the produsen that owns the Produk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produsen()
    {
        return $this->belongsTo(Produsen::class);
    }

    public function logKas()
    {
        return $this->morphMany(LogKas::class,'payer');
    }

    public function kasHarian()
    {
        return $this->morphMany(KasHarian::class,'payer');
    }

}


