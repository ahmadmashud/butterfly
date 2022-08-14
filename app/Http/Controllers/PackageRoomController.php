<?php

namespace App\Http\Controllers;

use App\Helpers\HelperCustom;
use App\Services\PackageRoomService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PackageRoomController extends Controller
{

    private PackageRoomService $packageRoomService;

    public function __construct(PackageRoomService $packageRoomService)
    {
        $this->packageRoomService = $packageRoomService;
    }

    public function index(): Response
    {
        if (HelperCustom::isValidAccess('M_PAKET')) {

            return abort(401);
        }
        $packageRoom = $this->packageRoomService->list();
        return response()
            ->view('packageRoom.index', [
                'data' =>  $packageRoom,
                'title' => 'Paket Room'
            ]);
    }

    public function get(Request $request, int $id)
    {
        $packageRoom = $this->packageRoomService->get($id);
        return response()->json([
            'data' => $packageRoom
        ]);
    }

    public function add(Request $request)
    {
        $this->packageRoomService->add($request);
        return redirect("/packageRooms");
    }

    public function delete(Request $request, int $id)
    {
        $this->packageRoomService->delete($id);
        return redirect("/packageRooms");
    }

    public function edit(Request $request)
    {
        $this->packageRoomService->edit($request);
        return redirect("/packageRooms");
    }
}
