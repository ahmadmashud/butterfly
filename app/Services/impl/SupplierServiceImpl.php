<?php

namespace App\Services\impl;

use App\Models\Supplier;
use App\Services\SupplierService;
use Illuminate\Http\Request;

class SupplierServiceImpl implements SupplierService
{
    function list()
    {
        return Supplier::all();
    }

    public function get(int $id)
    {
        return  Supplier::where('id', $id)->firstOrFail();
    }

    public function delete(int $id)
    {
        $supplier =  Supplier::where('id', $id)->firstOrFail();
        $supplier->delete();
    }

    function edit(Request $request)
    {
        // get by id
        $supplier =  Supplier::where('id', $request->id)->firstOrFail();
        $supplier->nama = $request->nama;
        $supplier->km_supplier = $request->km_supplier;
        $supplier->save();
    }
}
