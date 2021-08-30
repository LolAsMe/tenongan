<?php

namespace App\Models\Tenongan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
 */
class Produsen extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'produsen';
    protected $fillable = ['nama','kode'];

    /**
     * Get all of the produk for the Produsen
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produk()
    {
        return $this->hasMany(Produk::class);
    }

}
