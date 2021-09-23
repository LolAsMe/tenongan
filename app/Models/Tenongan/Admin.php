<?php

namespace App\Models\Tenongan;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'admin';
    protected $guarded = [];

    public function user()
    {
        return $this->morphOne(User::class, 'owner');
    }
}
