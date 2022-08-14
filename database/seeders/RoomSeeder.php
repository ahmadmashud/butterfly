<?php

namespace Database\Seeders;

use App\Helpers\HelperCustom;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = 
            [[
                'no' => '101',
                'code' => HelperCustom::generateTrxNo('RM', 1),
                'is_used' => false,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'no' => '102',
                'code' => HelperCustom::generateTrxNo('RM', 2),
                'is_used' => false,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'no' => '103',
                'code' => HelperCustom::generateTrxNo('RM', 3),
                'is_used' => false,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'no' => '104',
                'code' => HelperCustom::generateTrxNo('RM', 4),
                'is_used' => false,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]];
        DB::table('m_rooms')->insert($rooms);
    }
}
