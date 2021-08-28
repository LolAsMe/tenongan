<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProdusenSeeder extends Seeder
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
            'nama'=>'Budi',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('produsen')->insert([
            'kode'=>'002',
            'nama'=>'Rudi',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('produsen')->insert([
            'kode'=>'003',
            'nama'=>'Bada',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('produsen')->insert([
            'kode'=>'004',
            'nama'=>'Adam',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('produsen')->insert([
            'kode'=>'005',
            'nama'=>'Jenifer',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('produsen')->insert([
            'kode'=>'006',
            'nama'=>'Jef',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }
}
