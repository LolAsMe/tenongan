<?php

namespace App\Models\Tenongan;

use App\Models\Tenongan\Pedagang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tenongan\Produk;
use App\Models\Tenongan\Transaksi;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * App\Models\tenongan\Penjualan
 *
 * @property int $id
 * @property string $kode
 * @property int $produk_id
 * @property int $titip
 * @property int|null $laku
 * @property string $harga_jual
 * @property string $harga_beli
 * @property string $tanggal
 * @property string $keterangan
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $produsen_id
 * @property int|null $transaksi_id
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereHargaBeli($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereHargaJual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereLaku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereProdukId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereProdusenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereTitip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereTransaksiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $status
 * @property int $pedagang_id
 * @property-read Pedagang $pedagang
 * @property-read Produk $produk
 * @property-read \Illuminate\Database\Eloquent\Collection|Penjualan[] $transaksi
 * @property-read int|null $transaksi_count
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan wherePedagangId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penjualan whereStatus($value)
 */
class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $guarded = '';

    /**
     * Get the produk that owns the Penjualan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }

    /**
     * Get the pedagang that owns the Penjualan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pedagang(): BelongsTo
    {
        return $this->belongsTo(Pedagang::class);
    }

    public function transaksi(): BelongsToMany
    {
        return $this->belongsToMany(Transaksi::class)->withPivot('batch');
    }

    public static function createPenjualans($dataPenjualan)
    {
        $produkIds = array_column($dataPenjualan,'produk_id');
        $produk = Produk::findMany($produkIds);
        $penjualans = new Collection;
        try {
            foreach ($dataPenjualan as $key => $data) {
                $data['harga_beli'] = $produk->find($data['produk_id'])->harga_beli;
                $data['harga_jual'] = $produk->find($data['produk_id'])->harga_jual;
                $penjualan = Penjualan::create($data);
                $penjualans->push($penjualan);
            }
        } catch (\Throwable $th) {

            $penjualans->each(function($penjualan){
                $penjualan->forceDelete();
            });
            throw $th;
        }
        return $penjualans;
    }

    public function scopeTanggalNow($query)
    {
        // dd(now()->format('Y-m-d'));
        $now = now()->format('Y-m-d');
        return $query->whereBetween('tanggal',[$now.' 00:00:00', $now.' 23:59:59']);
    }
}
