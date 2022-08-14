<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prices =
            [[
                'type' => 'PAJAK',
                'nilai' => 35,
                'satuan' => 'PERCENTAGE',
                'is_default' => true,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'type' => 'SERVICE_CHARGE',
                'nilai' => 5,
                'satuan' => 'PERCENTAGE',
                'is_default' => true,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'type' => 'DISCOUNT',
                'nilai' => 20,
                'satuan' => 'PERCENTAGE',
                'is_default' => true,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]];
        DB::table('m_prices')->insert($prices);
    }
}
