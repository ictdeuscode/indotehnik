<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterPreorderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_preorders')->insert([
            [
                'nomor' => '2310322',
                'tanggal' => date('2023/1/3'),
                'customer' => 'PT. KARUNIA ALAM SEGAR',
                'quantity' => '9',
                'satuan' => 'Set',
                'explanation' => 'Slitter N22 Fuji Versi Ori',
                'keterangan' => 'Tidak ada catatan khusus di IRCII',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'nomor' => '2310323',
                'tanggal' => date('2023/1/3'),
                'customer' => 'CV. CIPTA AGUNG',
                'quantity' => '2',
                'satuan' => 'Pcs',
                'explanation' => 'Buat Baru Lock Nut ID=65 D=98mm T=20mm mat. S45C',
                'keterangan' => 'Tidak ada catatan khusus di IRCII',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'nomor' => '2310324',
                'tanggal' => date('2023/2/3'),
                'customer' => 'CV. Jaya Lestari',
                'quantity' => '3',
                'satuan' => 'Pcs',
                'explanation' => 'Key 8 x 8 x 300',
                'keterangan' => 'Tidak ada catatan khusus di IRCII',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
        ]);
    }
}
