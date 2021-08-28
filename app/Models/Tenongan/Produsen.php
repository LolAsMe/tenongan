<?php

namespace App\Models\Tenongan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produsen extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'produsen';

    protected $fillable = ['nama','kode'];

}
