<?php

namespace App\Services\impl;

use App\Helpers\HelperCustom;
use App\Models\FoodDrink;
use App\Services\FoodDrinkService;
use Illuminate\Http\Request;

class FoodDrinkServiceImpl implements FoodDrinkService
{
    function list()
    {
        return FoodDrink::all();
    }

    function add(Request $request)
    {
        $foodDrink['nama'] = $request->nama;
        $foodDrink['id_category_food_drink'] = $request->id_category_food_drink;
        $foodDrink['harga'] = $request->harga;
        $foodDrink['stock'] = $request->stock;
        $foodDrink['is_active'] = true;
        $foodDrink = FoodDrink::create($foodDrink);

        $foodDrink['code'] = HelperCustom::generateTrxNo('FD', $foodDrink->id);
        $foodDrink->save();
    }

    public function get(int $id)
    {
        return  FoodDrink::where('id', $id)->firstOrFail();
    }

    public function delete(int $id)
    {
        $foodDrink =  FoodDrink::where('id', $id)->firstOrFail();
        $foodDrink->delete();
    }

    function edit(Request $request)
    {
        // get by id
        $foodDrink =  FoodDrink::where('id', $request->id)->firstOrFail();
        $foodDrink->nama = $request->nama;
        $foodDrink->id_category_food_drink = $request->id_category_food_drink;
        $foodDrink->harga = $request->harga;
        $foodDrink->stock = $request->stock;
        $foodDrink->is_active = $request->is_active == "on" ? true : false;
        $foodDrink->save();
    }
}
