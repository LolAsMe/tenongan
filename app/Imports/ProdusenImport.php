<?php
namespace App\Imports;

use App\Models\Tenongan\Produsen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProdusenImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return Produsen::create([
            'nama'  => $row['nama'],
        ])->createSaldo();
    }
    public function headingRow(): int
    {
        return 2;
    }

}
