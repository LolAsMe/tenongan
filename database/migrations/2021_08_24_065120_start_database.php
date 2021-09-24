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
            $table->string('nama');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('produsen_id')->nullable();
            $table->unsignedDecimal('harga_jual');
            $table->unsignedDecimal('harga_beli');
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('pedagang', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('saldo', function (Blueprint $table) {
            $table->id();
            $table->decimal('jumlah', 16)->default(0);
            $table->morphs('owner');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('log_saldo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('saldo_id');
            $table->decimal('jumlah', 16)->default(0);
            $table->enum('status', [ 'Pending','Canceled','Paid Out','Ok','Draft'])->default('Ok');
            $table->dateTime('tanggal')->useCurrent();
            $table->string('keterangan')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('kas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->decimal('jumlah',15)->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('log_kas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kas_id');
            $table->dateTime('tanggal')->useCurrent();
            $table->decimal('jumlah')->default(0);
            $table->nullableMorphs('payer');
            $table->enum('status', [ 'Pending','Canceled','Paid Out','Ok','Draft'])->default('Ok');
            $table->string('keterangan')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal')->useCurrent();
            $table->decimal('jumlah',16);
            $table->morphs('owner');
            $table->enum('status', [ 'Pending','Canceled','Paid Out','Ok','Draft'])->default('Ok');
            $table->string('keterangan')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan')->nullable();
            $table->decimal('jumlah',14);
            $table->foreignId('produk_id');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id');
            $table->unsignedInteger('titip');
            $table->unsignedInteger('laku')->nullable();
            $table->unsignedDecimal('harga_jual');
            $table->unsignedDecimal('harga_beli');
            $table->dateTime('tanggal')->useCurrent();
            $table->enum('status', [ 'Pending','Ignored','Paid Out','Ok','Draft'])->default('Draft');
            $table->foreignId('pedagang_id');
            $table->string('keterangan')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('kas_harian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('log_kas_id')->nullable();
            $table->dateTime('tanggal')->useCurrent();
            $table->morphs('payer');
            $table->decimal('jumlah')->default(0);
            $table->enum('status', [ 'Pending','Canceled','Paid Out','Ok','Draft'])->default('Draft');
            $table->string('keterangan')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('penjualan_transaksi', function (Blueprint $table) {
            $table->unsignedBigInteger('penjualan_id')->unsigned()->index();
            $table->foreign('penjualan_id')->references('id')->on('penjualan')->onDelete('cascade');
            $table->unsignedBigInteger('transaksi_id')->unsigned()->index();
            $table->foreign('transaksi_id')->references('id')->on('transaksi')->onDelete('cascade');
            $table->primary(['penjualan_id', 'transaksi_id']);
        });

        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
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
        Schema::dropIfExists('penjualan_transaksi');
        Schema::dropIfExists('kas_harian');
        Schema::dropIfExists('log_saldo');
        Schema::dropIfExists('log_penjualan');
        Schema::dropIfExists('log_kas');
        Schema::dropIfExists('kas');
        Schema::dropIfExists('saldo');
        Schema::dropIfExists('penjualan');
        Schema::dropIfExists('transaksi');
        Schema::dropIfExists('detail_transaksi');
        Schema::dropIfExists('produk');
        Schema::dropIfExists('produsen');
        Schema::dropIfExists('admin');
        Schema::dropIfExists('pedagang');

    }
}
