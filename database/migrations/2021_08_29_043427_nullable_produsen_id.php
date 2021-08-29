<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NullableProdusenId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Produk', function (Blueprint $table) {
            //
            $table->unsignedInteger('produsen_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Produk', function (Blueprint $table) {
            //
            $table->unsignedInteger('produsen_id')->nullable(false)->change();

        });
    }
}
