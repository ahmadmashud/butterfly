<?php

namespace App\Services\impl;

use App\Helpers\HelperCustom;
use App\Models\PackageRoom;
use App\Services\PackageRoomService;
use Illuminate\Http\Request;

class PackageRoomServiceImpl implements PackageRoomService
{
    function list()
    {
        return PackageRoom::all();
    }

    function add(Request $request)
    {
        $packageRoom['nama'] = $request->nama;
        $packageRoom['harga'] = $request->harga;
        $packageRoom['km_supplier'] = $request->km_supplier;
        $packageRoom['km_terapis'] = $request->km_terapis;
        $packageRoom['is_active'] = true;

        $packageRoom = PackageRoom::create($packageRoom);
        $packageRoom['code'] = HelperCustom::generateTrxNo('PR', $packageRoom->id);
        $packageRoom->save();
    }

    public function get(int $id)
    {
        return  PackageRoom::where('id', $id)->firstOrFail();
    }

    public function delete(int $id)
    {
        $packageRoom =  PackageRoom::where('id', $id)->firstOrFail();
        $packageRoom->delete();
    }

    function edit(Request $request)
    {
        // get by id
        $packageRoom =  PackageRoom::where('id', $request->id)->firstOrFail();
        $packageRoom->nama = $request->nama;
        $packageRoom->harga = $request->harga;
        $packageRoom->km_terapis = $request->km_terapis;
        $packageRoom->km_supplier = $request->km_supplier;
        $packageRoom->is_active = $request->is_active == "on" ? true : false;
        $packageRoom->save();
    }
}
