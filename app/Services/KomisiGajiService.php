<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

interface KomisiGajiService
{
    function  getUser($id, $tanggal_awal, $tanggal_akhir);
    function  getTerapis($id, $tanggal_awal, $tanggal_akhir);
    function  getSupplier($tanggal_awal, $tanggal_akhir);
    function getRekapTerapis($tanggal_awal, $tanggal_akhir);
    function getRekapUser($tanggal_awal, $tanggal_akhir);
}
