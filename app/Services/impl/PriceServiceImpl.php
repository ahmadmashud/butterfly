<?php

namespace App\Services\impl;

use App\Models\Price;
use App\Services\PriceService;
use Illuminate\Http\Request;

class PriceServiceImpl implements PriceService
{
    function list()
    {
        return Price::all();
    }

    function add(Request $request)
    {
        $price['type'] = $request->type;
        $price['nilai'] = $request->nilai;
        $price['satuan'] = $request->satuan;
        Price::create($price);
    }

    public function get(int $id)
    {
        return  Price::where('id', $id)->firstOrFail();
    }

    public function delete(int $id)
    {
        $price =  Price::where('id', $id)->firstOrFail();
        $price->delete();
    }

    function edit(Request $request)
    {
        // get by id
        $price =  Price::where('id', $request->id)->firstOrFail();
        $price->type = $request->type;
        $price->nilai = $request->nilai;
        $price->satuan = $request->satuan;
        $price->save();
    }
}
