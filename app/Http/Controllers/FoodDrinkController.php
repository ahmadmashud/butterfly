<?php

namespace App\Http\Controllers;

use App\Helpers\HelperCustom;
use App\Services\CategoryFoodDrinkService;
use App\Services\FoodDrinkService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FoodDrinkController extends Controller
{

    private FoodDrinkService $foodDrinkService;
    private CategoryFoodDrinkService $categoryService;

    public function __construct(FoodDrinkService $foodDrinkService, CategoryFoodDrinkService $categoryService)
    {
        $this->foodDrinkService = $foodDrinkService;
        $this->categoryService = $categoryService;
    }

    public function index(): Response
    {
        if (HelperCustom::isValidAccess('M_FND')) {

            return abort(401);
        }
        $foodDrink = $this->foodDrinkService->list();
        $category = $this->categoryService->list();
        return response()
            ->view('foodDrink.index', [
                'data' =>  $foodDrink,
                'category' => $category,
                'title' => 'Makanan & Minuman'
            ]);
    }

    public function get(Request $request, int $id)
    {
        $foodDrink = $this->foodDrinkService->get($id);
        return response()->json([
            'data' => $foodDrink
        ]);
    }

    public function add(Request $request)
    {
        $this->foodDrinkService->add($request);
        return redirect("/foodDrinks");
    }

    public function delete(Request $request, int $id)
    {
        $this->foodDrinkService->delete($id);
        return redirect("/foodDrinks");
    }

    public function edit(Request $request)
    {
        $this->foodDrinkService->edit($request);
        return redirect("/foodDrinks");
    }
}
