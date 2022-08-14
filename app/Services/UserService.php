<?php

namespace App\Services;

use Illuminate\Http\Request;

interface UserService
{
    function login(Request $request): bool;
    function  list();
    function  add(Request $request);
    function  get(int $id);
    function  delete(int $id);
    function  edit(Request $request);
}
