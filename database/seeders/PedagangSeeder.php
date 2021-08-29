<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class PedagangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('produsen')->insert([
            'kode'=>'001',
            'nama'=>'Ari',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('produsen')->insert([
            'kode'=>'002',
            'nama'=>'Pareng',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('produsen')->insert([
            'kode'=>'003',
            'nama'=>'Katon',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }
}
