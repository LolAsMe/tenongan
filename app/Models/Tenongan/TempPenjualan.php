<?php

namespace App\Models\Tenongan;

use App\Models\tenongan\Penjualan;
use App\Models\User;
use App\Traits\Tenongan\HasSaldo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;

class TempPenjualan extends Model
{
    use HasFactory;

    protected $table = 'temp_file';

}
