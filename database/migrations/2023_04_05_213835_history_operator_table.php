<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HistoryOperatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_operators', function(Blueprint $table) {
            $table->id();
            // $table->string('nomor', 500)->nullable();
            $table->date('tanggal')->nullable();
            $table->string('nama_mesin', 500)->nullable();
            $table->string('nama_barang', 500)->nullable();
            $table->date('waktu')->nullable();
            $table->text('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_operators');
    }
}
