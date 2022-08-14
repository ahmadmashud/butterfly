<?php

namespace App\Http\Controllers;

use App\Helpers\HelperCustom;
use App\Services\PriceService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PriceController extends Controller
{

    private PriceService $priceService;

    public function __construct(PriceService $priceService)
    {
        $this->priceService = $priceService;
    }

    public function index(): Response
    {
        if (HelperCustom::isValidAccess('M_TARIF')) {

            return abort(401);
        }
        $price = $this->priceService->list();
        return response()
            ->view('price.index', [
                'data' =>  $price,
                'title' => 'Tarif Parameter'
            ]);
    }

    public function get(Request $request, int $id)
    {
        $price = $this->priceService->get($id);
        return response()->json([
            'data' => $price
        ]);
    }

    public function add(Request $request)
    {
        $this->priceService->add($request);
        return redirect("/prices");
    }

    public function delete(Request $request, int $id)
    {
        $this->priceService->delete($id);
        return redirect("/prices");
    }

    public function edit(Request $request)
    {
        $this->priceService->edit($request);
        return redirect("/prices");
    }
}
