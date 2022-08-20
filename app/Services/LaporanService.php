<?php

namespace App\Services;

use Illuminate\Http\Request;

interface LaporanService
{
    function  get($tanggal_awal, $tanggal_akhir, $metode_pembayaran);
    function  getFnd($tanggal_awal, $tanggal_akhir);
    function getProducts($tanggal_awal, $tanggal_akhir);
    function getProductsRekap($tanggal_awal, $tanggal_akhir);
    function  choose(Request $request);
}
