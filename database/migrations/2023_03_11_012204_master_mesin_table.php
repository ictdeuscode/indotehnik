<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class MasterMesinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_mesins', function(Blueprint $table) {
            $table->id();
            $table->string('kode', 500);
            $table->string('nama', 500);
            $table->text('keterangan');
            $table->integer('poin')->default(1);
            $table->integer('is_gudang_finish')->default(0);
            $table->integer('is_gudang_kirim')->default(0);
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
        Schema::dropIfExists('master_mesins');
    }
}

