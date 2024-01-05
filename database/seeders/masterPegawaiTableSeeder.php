<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class masterPegawaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_pegawais')->insert([
            [
                'kode' => 'AS02',
                'nama' => 'Andi Setiawan',
                'NPWP' => '1224234-234',
                'alamat' => 'taman alamanda blok d. 27',
                'provinsi' => 'jawa timur',
                'kota' => 'surabaya',
                'kecamatan' => 'sidoarjo',
                'kelurahan' => 'Buduran',
                'kode_pos' => '34535',
                'no_telp' => '083123234',
                'fax' => '45456',
                'email' => 'tes1@gmail.com',
                'kontak' => '1956234345',
                'password' => Hash::make('MakanSateEnak_22'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'kode' => 'BB01',
                'nama' => 'Bagas Bagus',
                'NPWP' => '1224234-234',
                'alamat' => 'Jalan Siwalankerto No. 121-131 Wonocolo',
                'provinsi' => 'jawa timur',
                'kota' => 'surabaya',
                'kecamatan' => 'wonocolo',
                'kelurahan' => '-',
                'kode_pos' => '1235',
                'no_telp' => '083123234',
                'fax' => '45456',
                'email' => 'tes2@gmail.com',
                'kontak' => '0813666345',
                'password' => Hash::make('SukaMakanRujak_69'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
        ]);
    }
}
