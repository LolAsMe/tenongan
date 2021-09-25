<?php
namespace App\Imports;

use App\Models\Tenongan\Pedagang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PedagangImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return Pedagang::create([
            'nama'  => $row['nama'],
        ])->createSaldo();
    }
    public function headingRow(): int
    {
        return 2;
    }

}
