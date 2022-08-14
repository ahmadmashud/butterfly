<?php

namespace App\Http\Controllers;

use App\Helpers\HelperCustom;
use App\Services\LokerService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LokerController extends Controller
{

    private LokerService $lokerService;

    public function __construct(LokerService $lokerService)
    {
        $this->lokerService = $lokerService;
    }

    public function index(): Response
    {
        if (HelperCustom::isValidAccess('M_LOKER')) {

            return abort(401);
        }
        $loker = $this->lokerService->list();
        return response()
            ->view('loker.index', [
                'data' =>  $loker,
                'title' => 'Loker'
            ]);
    }

    public function get(Request $request, int $id)
    {
        $loker = $this->lokerService->get($id);
        return response()->json([
            'data' => $loker
        ]);
    }

    public function add(Request $request)
    {
        $this->lokerService->add($request);
        return redirect("/lokers");
    }

    public function delete(Request $request, int $id)
    {
        $this->lokerService->delete($id);
        return redirect("/lokers");
    }

    public function edit(Request $request)
    {
        $this->lokerService->edit($request);
        return redirect("/lokers");
    }
}
