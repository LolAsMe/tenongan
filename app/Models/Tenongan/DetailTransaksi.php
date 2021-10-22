<?php

namespace App\Models\Tenongan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Tenongan\Transaksi
 *
 * @property int $id
 * @property string $kode
 * @property string $jumlah
 * @property int $produsen_id
 * @property string $tanggal
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereProdusenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $owner_type
 * @property int $owner_id
 * @property string $status
 * @property string|null $keterangan
 * @property-read mixed $tipe
 * @property-read Model|\Eloquent $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\tenongan\Penjualan[] $penjualan
 * @property-read int|null $penjualan_count
 * @property-read \App\Models\Tenongan\Produsen $produsen
 * @method static \Illuminate\Database\Query\Builder|Transaksi onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereOwnerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|Transaksi withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Transaksi withoutTrashed()
 */
class DetailTransaksi extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'detail_transaksi';
    protected $guarded = [];
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
