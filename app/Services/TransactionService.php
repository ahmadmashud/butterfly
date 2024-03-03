<?php

namespace App\Services;

use Illuminate\Http\Request;

interface TransactionService
{
    function  list();
    function  add(Request $request);
    function  cancel(int $id);
    function  stop(int $id);
    function  payment(Request $request);
    function  get(int $id);
    function  delete(int $id);
    function  edit(Request $request, int $id);
    function  editStatus(Request $request);
    function  rollback(int $id);
}
