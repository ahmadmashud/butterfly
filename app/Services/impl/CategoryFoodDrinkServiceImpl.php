<?php

namespace App\Services\impl;

use App\Models\CategoryFoodDrink;
use App\Services\CategoryFoodDrinkService;
use Illuminate\Http\Request;

class CategoryFoodDrinkServiceImpl implements CategoryFoodDrinkService
{
    function list()
    {
        return CategoryFoodDrink::all();
    }

    function add(Request $request)
    {
        $categoryFoodDrink['nama'] = $request->nama;
        $categoryFoodDrink['is_active'] = true;
        CategoryFoodDrink::create($categoryFoodDrink);
    }

    public function get(int $id)
    {
        return  CategoryFoodDrink::where('id', $id)->firstOrFail();
    }

    public function delete(int $id)
    {
        $categoryFoodDrink =  CategoryFoodDrink::where('id', $id)->firstOrFail();
        $categoryFoodDrink->delete();
    }

    function edit(Request $request)
    {
        // get by id
        $categoryFoodDrink =  CategoryFoodDrink::where('id', $request->id)->firstOrFail();
        $categoryFoodDrink->nama = $request->nama;
        $categoryFoodDrink->save();
    }
}
