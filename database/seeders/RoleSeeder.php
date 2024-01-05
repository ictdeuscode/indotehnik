<?php

namespace Database\Seeders;

use App\Models\MasterRole;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MasterRole::insert([
            ['nama' => 'Super Admin', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
