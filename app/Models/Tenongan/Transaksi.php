<?php

namespace App\Models\Tenongan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Relation;

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
class Transaksi extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'transaksi';
    protected $guarded = [];
    protected $appends = array('tipe');
    protected $hidden = [
        'owner_type',
    ];
    /**
     * Get all of the penjualan for the Transaksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function penjualan(): BelongsToMany
    {
        return $this->belongsToMany(Penjualan::class)->using(PenjualanTransaksi::class)->withPivot('batch');
    }

    /**
     * Get all of the penjualan for the Transaksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function penjualanTransaksi(): BelongsToMany
    {
        return $this->belongsToMany(Penjualan::class);
    }

    public function owner()
    {
        return $this->morphTo();
    }
    public function getTipeAttribute()
    {
        // $value =  substr($this->owner_type, strpos($this->owner_type, "n\\")+2);
        return $this->owner_type;
    }
    public function detail()
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    public function kas()
    {
        return $this->HasOne(DetailKas::class);
    }

    public function validateAttribute(array $attribute)
    {
        // $allowed  = ['keterangan', 'jumlah'];
        // $newAttribute = array_filter(
        //     $attribute,
        //     fn ($key) => in_array($key, $allowed),
        //     ARRAY_FILTER_USE_KEY
        // );
        $newAttribute['keterangan'] = $attribute['keterangan'] ?? "transaksi";
        return $newAttribute;
    }

    public function tambah($jumlah, array $attribute)
    {
        $validatedAttribute = $this->validateAttribute($attribute);
        $this->increment('jumlah', $jumlah);
        $this->detail()->create($validatedAttribute + ['jumlah'=>$jumlah]);
    }

    public function scopeTanggalNow($query)
    {
        // dd(now()->format('Y-m-d'));
        $now = now()->format('Y-m-d');
        return $query->whereBetween('tanggal',[$now.' 00:00:00', $now.' 23:59:59']);
    }

}
