<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Temp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('temp_penjualan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('temp_file_id')->nullable();
            $table->json('data');
        });
        Schema::create('temp_file', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->dateTime('tanggal')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temp_penjualan');
        Schema::dropIfExists('temp_file');
        //
    }
}
