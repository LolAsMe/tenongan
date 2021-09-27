<?php
namespace App\Exports;

use App\Models\tenongan\Penjualan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class ProdusenExport implements FromCollection
{
    use Exportable;

    public function collection()
    {
        return Penjualan::all();
    }
}
