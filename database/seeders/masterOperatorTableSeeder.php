<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class masterOperatorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_operators')->insert([
            [
                'kode' => 'AS02',
                'nama' => 'Andi Setiawan',
                'NPWP' => '1224234-234',
                'alamat' => ' Jalan Basuki Rahmat no. 8–12, Jalan Embong Malang no. 1–31',
                'jenis_operator' => 'mesin bubut',
                'scan_count' => '0',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'lkode' => 'AS01',
                'nama' => 'Bagas Bagus',
                'NPWP' => '1224234-234',
                'alamat' => 'Jalan Siwalankerto No. 121-131 Wonocolo',
                'jenis_operator' => 'mesin pencampur',
                'scan_count' => '0',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
        ]);
    }
}
