<?php

namespace App\Models\Tenongan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Tenongan\Pedagang
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
 */
class Pedagang extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'pedagang';
    protected $guarded = [];

    public function logKas()
    {
        return $this->morphMany(LogKas::class,'payer');
    }

}
