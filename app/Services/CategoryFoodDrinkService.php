<?php

namespace App\Services;

use Illuminate\Http\Request;

interface CategoryFoodDrinkService
{
    function  list();
    function  add(Request $request);
    function  get(int $id);
    function  delete(int $id);
    function  edit(Request $request);
}
