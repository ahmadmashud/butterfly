<?php

namespace Database\Seeders;

use App\Helpers\HelperCustom;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodDrinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $foodDrinks =
            [[
                'nama' => 'Coklat',
                'code' => HelperCustom::generateTrxNo('FD', 1),
                'id_category_food_drink' => 1,
                'harga' => 1000,
                'stock' => 1,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'nama' => 'Susu',
                'code' => HelperCustom::generateTrxNo('FD', 2),
                'id_category_food_drink' => 1,
                'harga' => 1000,
                'stock' => 1,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]];
        DB::table('m_food_drinks')->insert($foodDrinks);
    }
}
