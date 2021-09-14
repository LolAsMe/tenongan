<?php

namespace App\Models\Tenongan;

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
 */
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
