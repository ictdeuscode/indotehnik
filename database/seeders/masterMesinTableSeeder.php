<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class masterMesinTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_mesins')->insert([
            [
                'kode' => '123-456-789',
                'nama' => 'ABC-10',
                'keterangan' => 'berfungsi dengan lancar',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'kode' => '488-789-123',
                'nama' => 'BCA-22',
                'keterangan' => 'berfungsi dengan lancar',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
        ]);
    }
}
