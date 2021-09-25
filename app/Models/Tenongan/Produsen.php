<?php

namespace App\Models\Tenongan;

use App\Models\tenongan\Penjualan;
use App\Models\User;
use App\Traits\Tenongan\HasSaldo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Tenongan\Produsen
 *
 * @property int $id
 * @property string $kode
 * @property string $nama
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\Tenongan\ProdusenFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Produsen newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Produsen newQuery()
 * @method static \Illuminate\Database\Query\Builder|Produsen onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Produsen query()
 * @method static \Illuminate\Database\Eloquent\Builder|Produsen whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produsen whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produsen whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produsen whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produsen whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produsen whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Produsen withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Produsen withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tenongan\LogKas[] $logKas
 * @property-read int|null $log_kas_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tenongan\Produk[] $produk
 * @property-read int|null $produk_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tenongan\KasHarian[] $kasHarian
 * @property-read int|null $kas_harian_count
 * @property-read \App\Models\Tenongan\Saldo|null $saldo
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tenongan\Transaksi[] $transaksi
 * @property-read int|null $transaksi_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Penjualan[] $penjualan
 * @property-read int|null $penjualan_count
 * @property-read User|null $user
 */
class Produsen extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasSaldo;

    protected $table = 'produsen';
    protected $fillable = ['nama', 'kode'];










    /**
     * Get all of the produk for the Produsen
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
    public function logKas()
    {
        return $this->morphMany(LogKas::class, 'payer');
    }
    public function saldo()
    {
        return $this->morphOne(Saldo::class, 'owner');
    }
    public function transaksi()
    {
        return $this->morphMany(Transaksi::class, 'owner');
    }
    public function user()
    {
        return $this->morphOne(User::class, 'owner');
    }

    public function penjualan()
    {
        return $this->hasManyThrough(Penjualan::class, Produk::class);
    }

    // public function kasHarian()
    // {
    //     return $this->hasManyThrough(KasHarian::class, Produk::class);
    // }
    public function kasHarian()
    {
        return $this->hasManyThrough(KasHarian::class, Produk::class, 'produsen_id', 'payer_id', 'id', 'id')
            ->where(
                'payer_type',
                'App\Models\Tenongan\Produk'
            );
    }
}
