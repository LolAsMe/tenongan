<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class KasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('kas')->insert([
            'nama'=>'Utama',
            'jumlah'=>0,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }
}
