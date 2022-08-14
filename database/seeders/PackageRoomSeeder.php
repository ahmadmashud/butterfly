<?php

namespace Database\Seeders;

use App\Helpers\HelperCustom;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $package_rooms = 
            [[
                'nama' => 'Executive',
                'code' => HelperCustom::generateTrxNo('PR', 1),
                'harga' => 125000,
                'km_terapis' => 17500,
                'km_supplier' => 7000,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'nama' => 'Suite',
                'code' => HelperCustom::generateTrxNo('PR', 2),
                'harga' => 130000,
                'km_terapis' => 17500,
                'km_supplier' => 7000,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'nama' => 'Hotel',
                'code' => HelperCustom::generateTrxNo('PR', 3),
                'harga' => 150000,
                'km_terapis' => 17500,
                'km_supplier' => 7000,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]];
        DB::table('m_package_rooms')->insert($package_rooms);
    }
}
