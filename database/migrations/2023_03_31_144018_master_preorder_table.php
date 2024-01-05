<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class MasterPreorderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_preorders', function(Blueprint $table) {
            $table->id();
            $table->string('nomor', 500)->nullable();
            $table->date('tanggal')->nullable();
            $table->string('nama_barang', 255)->nullable();
            $table->string('customer', 500)->nullable();
            $table->string('quantity', 500)->nullable();
            $table->string('satuan', 500)->nullable();
            $table->text('explanation')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('is_stock')->nullable();
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
        Schema::dropIfExists('master_preorders');
    }
}
