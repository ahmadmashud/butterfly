<?php

namespace App\Http\Controllers;

use App\Services\CategoryFoodDrinkService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryFoodDrinkController extends Controller
{

    private CategoryFoodDrinkService $categoryFoodDrinkService;

    public function __construct(CategoryFoodDrinkService $categoryFoodDrinkService)
    {
        $this->categoryFoodDrinkService = $categoryFoodDrinkService;
    }

    public function index(): Response
    {
        $categoryFoodDrink = $this->categoryFoodDrinkService->list();
        return response()
            ->view('categoryFoodDrink.index', [
                'data' =>  $categoryFoodDrink,
                'title' => 'Kategori Food & Drink'
            ]);
    }

    public function get(Request $request, int $id)
    {
        $categoryFoodDrink = $this->categoryFoodDrinkService->get($id);
        return response()->json([
            'data' => $categoryFoodDrink
        ]);
    }

    public function add(Request $request)
    {
        $this->categoryFoodDrinkService->add($request);
        return redirect("/categoryFoodDrinks");
    }

    public function delete(Request $request, int $id)
    {
        $this->categoryFoodDrinkService->delete($id);
        return redirect("/categoryFoodDrinks");
    }

    public function edit(Request $request)
    {
        $this->categoryFoodDrinkService->edit($request);
        return redirect("/categoryFoodDrinks");
    }
}
