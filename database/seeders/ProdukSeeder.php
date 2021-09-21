<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('produk')->insert([
            'nama'=>'Corobikan',
            'produsen_id'=>1,
            'harga_jual'=>1500,
            'harga_beli'=>1300,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('produk')->insert([
            'nama'=>'Nyess',
            'produsen_id'=>1,
            'harga_jual'=>1500,
            'harga_beli'=>1200,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('produk')->insert([
            'nama'=>'Karang Gesing',
            'produsen_id'=>2,
            'harga_jual'=>1000,
            'harga_beli'=>800,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('produk')->insert([
            'nama'=>'Ati Tusuk',
            'produsen_id'=>3,
            'harga_jual'=>2000,
            'harga_beli'=>1800,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }
}
