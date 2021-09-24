<?php
namespace App\Models\Tenongan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * App\Models\Tenongan\KasHarian
 *
 * @property int $id
 * @property int|null $log_kas_id
 * @property string $tanggal
 * @property string $payer_type
 * @property int $payer_id
 * @property string $jumlah
 * @property string $status
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Tenongan\$value $tipe
 * @property-read \App\Models\Tenongan\LogKas|null $logKas
 * @property-read Model|\Eloquent $payer
 * @method static \Illuminate\Database\Eloquent\Builder|KasHarian newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KasHarian newQuery()
 * @method static \Illuminate\Database\Query\Builder|KasHarian onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|KasHarian query()
 * @method static \Illuminate\Database\Eloquent\Builder|KasHarian whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasHarian whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasHarian whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasHarian whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasHarian whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasHarian whereLogKasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasHarian wherePayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasHarian wherePayerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasHarian whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasHarian whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasHarian whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|KasHarian withTrashed()
 * @method static \Illuminate\Database\Query\Builder|KasHarian withoutTrashed()
 * @mixin \Eloquent
 */
class KasHarian extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'kas_harian';
    protected $guarded = [];
    protected $appends = array('tipe');
    protected $hidden = ['payer_type'];

    public function payer()
    {
        return $this->morphTo();
    }
    /**
     * Get the logKas that owns the KasHarian
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function logKas(): BelongsTo
    {
        return $this->belongsTo(LogKas::class);
    }
    /**
     * Get Tipe
     *
     * @return $value
     */
    public function getTipeAttribute()
    {
        $value =  substr($this->payer_type, strpos($this->payer_type, "n\\")+2);
        return $value;
    }
}
