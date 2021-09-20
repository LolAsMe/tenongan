<?php

namespace App\Repositories\Tenongan;

use App\Models\Tenongan\Kas;
use App\Models\tenongan\Penjualan;
use App\Models\Tenongan\Transaksi;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class TransaksiRepository
{
    protected $saldoRepository;
    protected $kasRepository;

    protected $owner;
    protected $transaksi;
    protected $attribute;

    public function __construct()
    {
        $this->saldoRepository = new SaldoRepository;
        $this->kasRepository = new KasRepository;
    }

    public function setOwner($owner)
    {
        $this->owner = $owner;
        return $this;
    }

    public function setAttribute(?array $attribute = null)
    {
        $this->attribute['tanggal'] = $attribute['tanggal'] ?? now();
        $this->attribute['jumlah'] = $attribute['jumlah'] ?? 0;
        $this->attribute['status'] = $attribute['status'] ?? 'Pending';
        $this->attribute['keterangan'] = $attribute['keterangan'] ?? null;

        return $this;
    }

    public function create(array $attribute = null)
    {
        $this->setAttribute($attribute);
        $transaksi = $this->owner->transaksi->create($this->attribute);
        return $transaksi;
    }

    public function firstOrCreate(?array $attribute = null)
    {
        $this->setAttribute($attribute);
        $transaksi = $this->owner->transaksi()->firstOrCreate(
            [
                'status' => $this->attribute['status']
            ],
            [
                'tanggal' => $this->attribute['tanggal'],
                'jumlah' => $this->attribute['jumlah'],
                'keterangan' => $this->attribute['keterangan']
            ]
        );
        $this->setTransaksi($transaksi);
    }

    public function setTransaksi(Transaksi $transaksi)
    {
        $this->transaksi = $transaksi;
    }

    public function tambahJumlahTransaksi(int $jumlah)
    {
        $this->transaksi->jumlah += $jumlah;
        $this->transaksi->save();
        return $this;
    }











    /**
     * Melakukan Transaksi
     *
     * @return void
     */
    public function transact()
    {
        // $this->checkPrevTransct();
        // Penjualan::whereStatus('Draft')->chunk(100,function($penjualans){
        //     foreach ($penjualans as $key => $penjualan) {
        //         $transaksi = Transaksi::firstOrCreate([
        //             "produsen_id" => $penjualan->produk->produsen_id,"status"=>'Pending'
        //         ],["jumlah" => 0,"tanggal"=>date("Y-m-d")]);
        //         $jumlah = $penjualan->laku * $penjualan->harga_beli;
        //         $penjualan->status='pending';
        //         $transaksi->jumlah += $jumlah;
        //         $transaksi->penjualan()->save($penjualan);
        //         $transaksi->save();
        //         $penjualan->save();
        //     }
        // });
    }

    /**
     * Mengecek apakah ada transaksi yang berstatus pending, apabila ada dihapus
     *
     * @return void
     */
    public function checkPrevTransct()
    {
        if ($transaksi = Transaksi::whereStatus('Pending')) {
            $transaksi->forceDelete();
        } else {
        }
    }

    /**
     * Menmbayar uang yang masih pending,
     *
     * @return void
     */
    public function pay()
    {
        // Penjualan::whereStatus('Pending')->chunkById(100, function ($penjualans) {
        //     foreach ($penjualans as $key => $penjualan) {
        //         $jumlah = $penjualan->harga_beli * $penjualan->laku;
        //         $saldo = $penjualan->pedagang->saldo;
        //         $this->saldoRepository->setOwner($saldo)->decrease(['jumlah' => $jumlah]);
        //         $penjualan->status = "Ok";
        //         $penjualan->save();
        //     }
        // });
        // Transaksi::whereStatus('Pending')->chunkById(100, function ($transaksis) {
        //     foreach ($transaksis as $key => $transaksi) {
        //         $transaksi->status = "Ok";
        //         $transaksi->save();
        //     }
        // });
    }
}
