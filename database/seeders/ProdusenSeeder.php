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
            'nama'=>'Budi',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('produsen')->insert([
            'nama'=>'Rudi',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('produsen')->insert([
            'nama'=>'Bada',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('produsen')->insert([
            'nama'=>'Adam',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }
}
