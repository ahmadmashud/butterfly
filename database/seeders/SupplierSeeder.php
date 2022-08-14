<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = 
            [[
                'nama' => 'supplier',
                'km_supplier' => 7000,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]];
        DB::table('m_suppliers')->insert($suppliers);
    }
}
