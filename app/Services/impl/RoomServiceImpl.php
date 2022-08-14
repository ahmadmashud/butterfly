<?php

namespace App\Services\impl;

use App\Helpers\HelperCustom;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Services\RoomService;

class RoomServiceImpl implements RoomService
{
    function list()
    {
        return Room::all();
    }

    function add(Request $request)
    {
        $room['no'] = $request->no;
        $room['is_used'] = $request->is_used == "on" ? 0 : 1;
        $room['is_active'] = true;

        $room = Room::create($room);
        $room['code'] = HelperCustom::generateTrxNo('RM', $room->id);
        $room->save();
    }

    public function get(int $id)
    {
        return  Room::where('id', $id)->firstOrFail();
    }

    public function delete(int $id)
    {
        $room =  Room::where('id', $id)->firstOrFail();
        $room->delete();
    }

    function edit(Request $request)
    {
        // get by id
        $room =  Room::where('id', $request->id)->firstOrFail();
        $room->no = $request->no;
        $room->is_used = $request->is_used == "on" ? 0 : 1;
        $room->is_active = $request->is_active == "on" ? true : false;
        $room->save();
    }
}
