<?php

namespace App\Http\Controllers;

use App\Helpers\HelperCustom;
use App\Services\SessionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SessionController extends Controller
{

    private SessionService $sessionService;

    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    public function index(): Response
    {
        if (HelperCustom::isValidAccess('M_SESI')) {

            return abort(401);
        }
        $session = $this->sessionService->list();
        return response()
            ->view('session.index', [
                'data' =>  $session,
                'title' => 'Sesi'
            ]);
    }

    public function get(Request $request, int $id)
    {
        $session = $this->sessionService->get($id);
        return response()->json([
            'data' => $session
        ]);
    }

    public function edit(Request $request)
    {
        $this->sessionService->edit($request);
        return redirect("/sessions");
    }
}
