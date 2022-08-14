<?php

namespace App\Services;

use Illuminate\Http\Request;

interface SupplierService
{
    function  list();
    function  get(int $id);
    function  delete(int $id);
    function  edit(Request $request);
}
