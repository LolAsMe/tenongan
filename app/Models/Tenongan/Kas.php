<?php

namespace App\Models\Tenongan;

use App\Traits\Tenongan\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;



use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * App\Models\Tenongan\Kas
 *
 * @property int $id
 * @property string $nama
 * @property string $kode
 * @property string $jumlah
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tenongan\LogKas[] $logKas
 * @property-read int|null $log_kas_count
 * @method static \Illuminate\Database\Eloquent\Builder|Kas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kas newQuery()
 * @method static \Illuminate\Database\Query\Builder|Kas onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Kas query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kas whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kas whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kas whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kas whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kas whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Kas withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Kas withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tenongan\LogKas[] $log
 * @property-read int|null $log_count
 */
class Kas extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasLog;
    protected $table = 'kas';
    protected $guarded = [];
    protected $lastLog;

    /**
     * Get all of the logKas for the Kas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function log(): HasMany
    {
        return $this->hasMany(LogKas::class);
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
        $this->lastLog = $this->log()->create($attributes);
        return $this;
    }
    /**
     * Mengurang Kas
     *
     * @param integer $jumlah
     * @param array $extra
     * @return void
     */
    public function decrease(int $jumlah , array $extra = [])
    {
        $attributes = array_merge(['jumlah'=>$jumlah,'tanggal'=>now()], $extra);
        $this->decrement('jumlah',$jumlah);
        $this->lastLog = $this->log()->create($attributes);
        return $this;
    }
}
