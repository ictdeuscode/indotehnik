<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class MasterOperatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_operators', function(Blueprint $table) {
            $table->id();
            $table->string('kode', 500);
            $table->string('nama', 500);
            $table->string('NPWP', 500);
            $table->string('alamat', 500);
            $table->string('jenis_operator', 500);
            $table->integer('scan_count')->default(0);
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
        Schema::dropIfExists('master_operators');
    }
}
