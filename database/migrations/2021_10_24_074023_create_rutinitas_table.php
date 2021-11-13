<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRutinitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rutinitas', function (Blueprint $table) {
            $table->id();
            $table->decimal('jumlah')->default(0);
            $table->string('keterangan')->nullable();
            $table->integer('frekuensi')->default(0);
            $table->morphs('sender');
            $table->nullableMorphs('receiver');
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
        Schema::dropIfExists('rutinitas');
    }
}
