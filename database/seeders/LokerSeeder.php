<?php

namespace Database\Seeders;

use App\Helpers\HelperCustom;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LokerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lokers = 
            [[
                'no' => 'B1',
                'code' => HelperCustom::generateTrxNo('LR', 1),
                'is_used' => false,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'no' => 'B2',
                'code' => HelperCustom::generateTrxNo('LR', 2),
                'is_used' => false,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'no' => 'B3',
                'code' => HelperCustom::generateTrxNo('LR', 3),
                'is_used' => false,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'no' => 'B4',
                'code' => HelperCustom::generateTrxNo('LR', 4),
                'is_used' => false,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]];
        DB::table('m_lokers')->insert($lokers);
    }
}
