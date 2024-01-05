<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class MasterPegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_pegawais', function(Blueprint $table) {
            // $idgenerate=['table' =>'pegawais', 'length'=>8, 'prefix'=>'InT-'];
            // $id = IdGenerator::generate($idgenerate);
            $table->id();
            $table->string('kode', 500);
            $table->string('nama', 500);
            $table->string('NPWP', 500);
            $table->string('alamat', 500);
            $table->string('provinsi', 500);
            $table->string('kota', 500);
            $table->string('kecamatan', 500);
            $table->string('kelurahan', 500);
            $table->string('kode_pos', 500);
            $table->string('no_telp', 500);
            $table->string('fax', 500);
            $table->string('email', 500);
            $table->string('kontak', 500);
            $table->string('password', 500);
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
        Schema::dropIfExists('master_pegawais');
    }
}
