<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_users')->insert([
            'nama' => "admin",
            'username' => "admin",
            'password' => "admin",
            'tanggal_join' => '2022-07-30',
            'is_active' => true,
            'role_id' => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
