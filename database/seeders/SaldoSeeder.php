<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaldoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('saldo')->insert([
            'jumlah'=>0,
            'owner_type'=>'App\Models\Tenongan\Pedagang',
            'owner_id'=>1,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);

        DB::table('saldo')->insert([
            'jumlah'=>0,
            'owner_type'=>'App\Models\Tenongan\Pedagang',
            'owner_id'=>2,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('saldo')->insert([
            'jumlah'=>0,
            'owner_type'=>'App\Models\Tenongan\Pedagang',
            'owner_id'=>3,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('saldo')->insert([
            'jumlah'=>0,
            'owner_type'=>'App\Models\Tenongan\Pedagang',
            'owner_id'=>4,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('saldo')->insert([
            'jumlah'=>0,
            'owner_type'=>'App\Models\Tenongan\Produsen',
            'owner_id'=>1,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('saldo')->insert([
            'jumlah'=>0,
            'owner_type'=>'App\Models\Tenongan\Produsen',
            'owner_id'=>2,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('saldo')->insert([
            'jumlah'=>0,
            'owner_type'=>'App\Models\Tenongan\Produsen',
            'owner_id'=>3,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('saldo')->insert([
            'jumlah'=>0,
            'owner_type'=>'App\Models\Tenongan\Produsen',
            'owner_id'=>4,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }
}
