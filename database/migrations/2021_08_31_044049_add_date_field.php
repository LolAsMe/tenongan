<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            //
            $table->date('tanggal')->after('produsen_id');
        });
        Schema::table('penjualan', function (Blueprint $table) {
            //
            $table->date('tanggal')->after('harga_beli');
            $table->foreignId('produsen_id')->constrained('produsen');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            //
            $table->dropColumn('tanggal');

        });
        Schema::table('penjualan', function (Blueprint $table) {
            //
            $table->dropColumn('tanggal');
            $table->dropConstrainedForeignId('produsen_id');

        });
    }
}
