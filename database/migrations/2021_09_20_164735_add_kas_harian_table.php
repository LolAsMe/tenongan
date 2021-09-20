<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKasHarianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kas_harian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('log_kas_id')->nullable()->constrained('log_kas');
            $table->date('tanggal');
            $table->morphs('payer');
            $table->decimal('jumlah');
            $table->enum('status', [ 'Pending','Canceled','Paid Out','Ok','Draft']);
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
        Schema::dropIfExists('kas_harian');
    }
}
