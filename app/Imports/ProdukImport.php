<?php
namespace App\Imports;

use App\Models\Tenongan\Produk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProdukImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return Produk::create([
            'nama'  => $row['nama'],
            'produsen_id'  => $row['produsen_id'],
            'harga_jual'  => $row['harga_jual'],
            'harga_beli'  => $row['harga_beli'],
        ]);
    }
    public function headingRow(): int
    {
        return 2;
    }

}
