<?php

namespace App\Models\Tenongan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Tenongan\LogSaldo
 *
 * @property int $id
 * @property string $kode
 * @property int $saldo_id
 * @property string $jumlah
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Tenongan\Saldo $saldo
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo newQuery()
 * @method static \Illuminate\Database\Query\Builder|LogSaldo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo query()
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo whereSaldoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|LogSaldo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|LogSaldo withoutTrashed()
 * @mixin \Eloquent
 * @property string $status
 * @property string $tanggal
 * @property string|null $keterangan
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogSaldo whereTanggal($value)
 */
class LogSaldo extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'log_saldo';
    protected $guarded = [];

    /**
     * Get the saldo that owns the LogSaldo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function saldo(): BelongsTo
    {
        return $this->belongsTo(Saldo::class);
    }

    public function payer()
    {
        $this->morphTo();
    }

}
