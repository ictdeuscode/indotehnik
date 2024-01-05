<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HistoryMesinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_mesins', function(Blueprint $table) {
            $table->id();
            // $table->string('nomor', 500)->nullable();
            $table->string('nama_mesin', 500)->nullable();
            $table->string('no_surat', 500)->nullable();
            $table->string('nama_operator', 500)->nullable();
            $table->date('tanggal')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('poin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_mesins');
    }
}
