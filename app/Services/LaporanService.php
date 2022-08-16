<?php

namespace App\Services;

interface LaporanService
{
    function  get($tanggal_awal, $tanggal_akhir, $metode_pembayaran);
    function  getFnd($tanggal_awal, $tanggal_akhir);
    function getProducts($tanggal_awal, $tanggal_akhir);
}
