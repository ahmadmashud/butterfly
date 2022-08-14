<?php

namespace Database\Seeders;

use App\Helpers\HelperCustom;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TerapisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $terapis = 
            [[
                'nama' => 'YUNITA',
                'code' => HelperCustom::generateTrxNo('TP', 1),
                'foto' => 'hqdefault_1659780901.jpg',
                'status' => 'AVAILABLE',
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'nama' => 'SHILA',
                'code' => HelperCustom::generateTrxNo('TP', 2),
                'foto' => 'hqdefault_1659780901.jpg',
                'status' => 'AVAILABLE',
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'nama' => 'NISA',
                'code' => HelperCustom::generateTrxNo('TP', 3),
                'foto' => 'hqdefault_1659780901.jpg',
                'status' => 'AVAILABLE',
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'nama' => 'YUKI',
                'code' => HelperCustom::generateTrxNo('TP', 4),
                'foto' => 'hqdefault_1659780901.jpg',
                'status' => 'AVAILABLE',
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]];
        DB::table('m_terapis')->insert($terapis);
    }
}
