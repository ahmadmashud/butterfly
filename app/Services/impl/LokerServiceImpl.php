<?php

namespace App\Services\impl;

use App\Helpers\HelperCustom;
use App\Models\Loker;
use App\Services\LokerService;
use Illuminate\Http\Request;

class LokerServiceImpl implements LokerService
{
    function list()
    {
        return Loker::all();
    }

    function add(Request $request)
    {
        $loker['no'] = $request->no;
        $loker['is_used'] = $request->is_used == "on" ? 0 : 1;
        $loker['is_active'] = true;
        $loker = Loker::create($loker);
        $loker['code'] = HelperCustom::generateTrxNo('LR', $loker->id);
        $loker->save();
    }

    public function get(int $id)
    {
        return  Loker::where('id', $id)->firstOrFail();
    }

    public function delete(int $id)
    {
        $loker =  Loker::where('id', $id)->firstOrFail();
        $loker->delete();
    }

    function edit(Request $request)
    {
        // get by id
        $loker =  Loker::where('id', $request->id)->firstOrFail();
        $loker->no = $request->no;
        $loker->is_used = $request->is_used == "on" ? 0 : 1;
        $loker->is_active = $request->is_active == "on" ? true : false;
        $loker->save();
    }
}
