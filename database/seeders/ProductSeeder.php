<?php

namespace Database\Seeders;

use App\Helpers\HelperCustom;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = 
            [[
                'nama' => 'Scrub Lulur',
                'code' => HelperCustom::generateTrxNo('PD', 1),
                'harga' => 120000,
                'km_terapis' => 50000,
                'km_gro' => 3000,
                'km_spv' => 1500,
                'km_staff' => 1500,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'nama' => 'Aromatic Spa',
                'code' => HelperCustom::generateTrxNo('PD', 2),
                'harga' => 95000,
                'km_terapis' => 50000,
                'km_gro' => 3000,
                'km_spv' => 1500,
                'km_staff' => 1500,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'nama' => 'Lulur',
                'code' => HelperCustom::generateTrxNo('PD', 3),
                'harga' => 75000,
                'km_terapis' => 30000,
                'km_gro' => 3000,
                'km_spv' => 1500,
                'km_staff' => 1500,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'nama' => 'Lavenda',
                'code' => HelperCustom::generateTrxNo('PD', 4),
                'harga' => 65000,
                'km_terapis' => 25000,
                'km_gro' => 3000,
                'km_spv' => 1500,
                'km_staff' => 1500,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]];
        DB::table('m_products')->insert($products);
    }
}
