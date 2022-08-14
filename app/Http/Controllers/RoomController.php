<?php

namespace App\Http\Controllers;

use App\Helpers\HelperCustom;
use App\Services\RoomService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoomController extends Controller
{

    private RoomService $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService= $roomService;
    }

    public function index(): Response
    {
        if (HelperCustom::isValidAccess('M_ROOM')) {

            return abort(401);
        }
        $room = $this->roomService->list();
        return response()
            ->view('room.index', [
                'data' =>  $room,
                'title' => 'Room'
            ]);
    }

    public function get(Request $request, int $id)
    {
        $room = $this->roomService->get($id);
        return response()->json([
            'data' => $room
        ]);
    }

    public function add(Request $request)
    {
        $this->roomService->add($request);
        return redirect("/rooms");
    }

    public function delete(Request $request, int $id)
    {
        $this->roomService->delete($id);
        return redirect("/rooms");
    }

    public function edit(Request $request)
    {
        $this->roomService->edit($request);
        return redirect("/rooms");
    }
}
