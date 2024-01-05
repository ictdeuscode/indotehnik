<?php

namespace Database\Seeders;

use App\Models\MasterPermission;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MasterPermission::insert([
            ['nama' => 'informasi_dashboard', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama' => 'master_role', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama' => 'master_permission_role', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama' => 'master_pegawai', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama' => 'master_operator', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama' => 'master_mesin', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama' => 'master_nomor_order', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama' => 'qr', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama' => 'laporan_detail_pengerjaan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama' => 'laporan_poin_karyawan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama' => 'laporan_reject', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama' => 'laporan_reject_customer', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama' => 'laporan_stock', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama' => 'export_backup', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
