<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HistorySuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_surats', function(Blueprint $table) {
            $table->id();
            // $table->string('nomor', 500)->nullable();
            $table->integer('id_surat')->nullable();
            $table->string('no_surat', 500)->nullable();
            $table->date('tanggal')->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->string('nama_mesin', 500)->nullable();
            $table->integer('id_mesin')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('keterangan_proses')->nullable();
            $table->integer('id_operator')->nullable();
            $table->string('nama_operator', 500)->nullable();
            $table->string('nama_operator_keluar', 500)->nullable();
            $table->string('image', 300)->nullable();
            $table->integer('is_approve')->default(0);
            $table->integer('is_reject')->default(0);
            $table->timestamp('tanggal_reject')->nullable();
            $table->text('keterangan_reject')->nullable();
            $table->integer('tipe_reject')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_surats');
    }
}
