<?php

namespace App\Services\impl;

use App\Models\Session;
use App\Services\SessionService;
use Illuminate\Http\Request;

class SessionServiceImpl implements SessionService
{
    function list()
    {
        return Session::all();
    }

    public function get(int $id)
    {
        return  Session::where('id', $id)->firstOrFail();
    }

    function edit(Request $request)
    {
        // get by id
        $session =  Session::where('id', $request->id)->firstOrFail();
        $session->waktu_per_sesi = $request->waktu_per_sesi;
        $session->minimum_sesi = $request->minimum_sesi;
        $session->harga = $request->harga;
        $session->discount = $request->discount/100;
        $session->discount_sesi_ke = $request->discount_sesi_ke;
        $session->save();
    }
}
