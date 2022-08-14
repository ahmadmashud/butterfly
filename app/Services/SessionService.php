<?php

namespace App\Services;

use Illuminate\Http\Request;

interface SessionService
{
    function  list();
    function  get(int $id);
    function  edit(Request $request);
}
