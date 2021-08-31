<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMorphableField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_kas', function (Blueprint $table) {
            //
            $table->nullableMorphs('payer');
            $table->string('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_kas', function (Blueprint $table) {
            //
            $table->dropMorphs('payer');
            $table->dropColumn('keterangan');
        });
    }
}
