<?php

namespace App\Models\Tenongan;

use App\Models\tenongan\Penjualan;
use App\Models\User;
use App\Traits\Tenongan\HasSaldo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Tenongan\Pedagang
 * 
 * @@ -41,7 +40,7 @@
 *
 * @property int $id
 * @property string $kode
 * @property string $nama
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\Tenongan\PedagangFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedagang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pedagang newQuery()
 * @method static \Illuminate\Database\Query\Builder|Pedagang onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Pedagang query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pedagang whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedagang whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedagang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedagang whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedagang whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedagang whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Pedagang withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Pedagang withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tenongan\LogKas[] $logKas
 * @property-read int|null $log_kas_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tenongan\KasHarian[] $kasHarian
 * @property-read int|null $kas_harian_count
 * @property-read \App\Models\Tenongan\Saldo|null $saldo
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tenongan\Transaksi[] $transaksi
 * @property-read int|null $transaksi_count
 * @property-read mixed $tipe
 * @property-read Model|\Eloquent $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|Penjualan[] $penjualan
 * @property-read int|null $penjualan_count
 * @property-read User|null $user
 */
class Pedagang extends Model
{
    use HasSaldo;
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pedagang';
    protected $guarded = [];
    public function logKas()
    {
        return $this->morphMany(LogKas::class,'payer');
    }
    public function kasHarian()
    {
        return $this->morphMany(KasHarian::class,'payer');
    }
    /**
     * Get the saldo associated with the Pedagang
     *
     *
     */
    public function saldo()
    {
        return $this->morphOne(Saldo::class,'owner');
    }
    public function transaksi()
    {
        return $this->morphMany(Transaksi::class,'owner');
    }

    public function owner()
    {
        return $this->morphTo();
    }

    public function getTipeAttribute()
    {
        $value =  substr($this->owner_type, strpos($this->owner_type, "n\\")+2);
        return $value;
    }
    public function user()
    {
        return $this->morphOne(User::class, 'owner');
    }

    public function penjualan(){
        return $this->hasMany(Penjualan::class);
    }
}
