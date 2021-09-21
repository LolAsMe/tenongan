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
        DB::table('pedagang')->insert([
            'nama'=>'Ari',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('pedagang')->insert([
            'nama'=>'Pareng',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('pedagang')->insert([
            'nama'=>'Katon',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('pedagang')->insert([
            'nama'=>'Abdul',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }
}
