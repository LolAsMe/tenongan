<?php

namespace App\Models\Tenongan;

use App\Traits\Tenongan\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * App\Models\Tenongan\Saldo
 *
 * @property int $id
 * @property string $kode
 * @property string $saldo
 * @property int $pedagang_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tenongan\LogSaldo[] $logSaldo
 * @property-read int|null $log_saldo_count
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo newQuery()
 * @method static \Illuminate\Database\Query\Builder|Saldo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo wherePedagangId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo whereSaldo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Saldo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Saldo withoutTrashed()
 * @mixin \Eloquent
 * @property string $jumlah
 * @property string $owner_type
 * @property int $owner_id
 * @property-read mixed $tipe
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tenongan\LogSaldo[] $log
 * @property-read int|null $log_count
 * @property-read Model|\Eloquent $owner
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saldo whereOwnerType($value)
 */
class Saldo extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasLog;

    protected $table = 'saldo';
    protected $guarded = [];
    protected $appends = array('tipe');

    /**
     * Get all of the logSaldo for the Saldo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function log(): HasMany
    {
        return $this->hasMany(LogSaldo::class);
    }
    /**
     * Get the pedagang that owns the Saldo
     *
     */
    public function owner()
    {
        return $this->morphTo('owner');
    }
    public function getTipeAttribute()
    {
        $value =  substr($this->owner_type, strpos($this->owner_type, "n\\")+2);
        return $value;
    }

    /**
     * Menambah Kas
     *
     * @param integer $jumlah
     * @param array $extra
     * @return void
     */
    public function increase(int $jumlah , array $extra = [])
    {
        $attributes = array_merge(['jumlah'=>$jumlah,'tanggal'=>now()], $extra);
        $this->increment('jumlah',$jumlah);
        $this->log()->create($attributes);
        return $this;
    }
    /**
     * Mengurangi Kas
     *
     * @param integer $jumlah
     * @param array $extra
     * @return void
     */
    public function decrease(int $jumlah , array $extra = [])
    {
        $extra['jumlah']=-$jumlah;
        $attributes = array_merge(['jumlah'=>-$jumlah,'tanggal'=>now()], $extra);
        $this->decrement('jumlah',$jumlah);
        $this->log()->create($attributes);
        return $this;
    }
}
