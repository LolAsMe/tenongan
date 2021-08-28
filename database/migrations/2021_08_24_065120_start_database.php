<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StartDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('produsen', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama');
            $table->foreignId('produsen_id');
            $table->unsignedDecimal('harga_jual');
            $table->unsignedDecimal('harga_beli');
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('pedagang', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('saldo', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->decimal('saldo', 16);
            $table->foreignId('pedagang_id');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('log_saldo', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->foreignId('saldo_id');
            $table->decimal('jumlah', 16);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('kas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kode')->unique();
            $table->decimal('jumlah',15);
            $table->foreignId('pedagang_id');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('log_kas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kas_id');
            $table->string('kode')->unique();
            $table->decimal('jumlah');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->decimal('jumlah',16);
            $table->foreignId('produsen_id');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('keterangan');
            $table->decimal('jumlah',14);
            $table->foreignId('produk_id');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('log_penjualan', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->foreignId('produk_id');
            $table->unsignedInteger('titip');
            $table->unsignedInteger('laku');
            $table->unsignedDecimal('harga_jual');
            $table->unsignedDecimal('harga_beli');
            $table->string('keterangan');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('produsen');
        Schema::dropIfExists('produk');
        Schema::dropIfExists('pedagang');
        Schema::dropIfExists('saldo');
        Schema::dropIfExists('log_saldo');
        Schema::dropIfExists('log_penjualan');
        Schema::dropIfExists('kas');
        Schema::dropIfExists('log_kas');
        Schema::dropIfExists('transaksi');
        Schema::dropIfExists('detail_transaksi');
    }
}
