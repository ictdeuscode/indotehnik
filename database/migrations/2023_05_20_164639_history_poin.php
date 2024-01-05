<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HistoryPoin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_poins', function (Blueprint $table) {
            $table->id();
            // $table->string('nomor', 500)->nullable();
            $table->integer('id_operator', 500);
            $table->integer('id_history_surat', 500);
            $table->enum('posisi', ['D', 'K']);
            $table->integer('poin')->default(0);
            // $table->string('nama_mesin', 500)->nullable();
            // $table->integer('poin_mesin')->default(1);
            $table->date('tanggal')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('history_poins');
    }
}
