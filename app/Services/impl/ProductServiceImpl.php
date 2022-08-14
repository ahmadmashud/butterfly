<?php

namespace App\Services\impl;

use App\Helpers\HelperCustom;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductServiceImpl implements ProductService
{

    function list()
    {
        return Product::all();
    }

    function add(Request $request)
    {
        $product['nama'] = $request->nama;
        $product['harga'] = $request->harga;
        $product['km_terapis'] = $request->km_terapis;
        $product['km_gro'] = $request->km_gro;
        $product['km_spv'] = $request->km_spv;
        $product['km_staff'] = $request->km_staff;
        $product['is_active'] = true;

        $product = Product::create($product);
        $product['code'] = HelperCustom::generateTrxNo('PD', $product->id);
        $product->save();
    }

    public function get(int $id)
    {
        return  Product::where('id', $id)->firstOrFail();
    }

    public function delete(int $id)
    {
        $product =  Product::where('id', $id)->firstOrFail();
        $product->delete();
    }

    function edit(Request $request)
    {
        // get by id
        $product =  Product::where('id', $request->id)->firstOrFail();
        $product->nama = $request->nama;
        $product->harga = $request->harga;
        $product->km_terapis = $request->km_terapis;
        $product->km_gro = $request->km_gro;
        $product->km_spv = $request->km_spv;
        $product->km_staff = $request->km_staff;
        $product->is_active = $request->is_active == "on" ? true : false;
        $product->save();
    }
}
