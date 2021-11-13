<?php

namespace App\Models\Tenongan;

use App\Traits\Tenongan\HasSaldo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rutinitas extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasSaldo;

    protected $table = 'rutinitas';
    protected $guarded = [];


    public function sender()
    {
        return $this->morphTo();
    }
}
