<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryFoodDrinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryFoodDrinks =
            [[
                'nama' => 'Makanan',
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'nama' => 'Minuman',
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]];
        DB::table('m_category_food_drinks')->insert($categoryFoodDrinks);
    }
}
