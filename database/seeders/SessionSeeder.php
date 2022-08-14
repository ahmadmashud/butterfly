<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sessions =
            [[
                'waktu_per_sesi' => 45,
                'minimum_sesi' => 2,
                'harga' => 125000,
                'discount' => 0.2,
                'discount_sesi_ke' => 2,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]];
        DB::table('m_sessions')->insert($sessions);
    }
}
