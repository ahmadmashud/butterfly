<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function home()
    {
        
        return redirect("/transactions");
        // if($request->session()->exists("user")){
        //     return response()->view("todolist.todolist", [
        //         "title"=> "TodoList"
        //     ]);
        // }else{
        //     return redirect("/login");
        // }
    }
        
}
