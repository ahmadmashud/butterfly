<?php

namespace Database\Seeders;

use App\Models\CategoryFoodDrink;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            LokerSeeder::class,
            ProductSeeder::class,
            RoomSeeder::class,
            TerapisSeeder::class,
            CategoryFoodDrinkSeeder::class,
            FoodDrinkSeeder::class,
            SupplierSeeder::class,
            PackageRoomSeeder::class,
            SessionSeeder::class,
            RoleSeeder::class,
            PriceSeeder::class,
            PrivilegeSeeder::class,
            RolePrivilegeSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
