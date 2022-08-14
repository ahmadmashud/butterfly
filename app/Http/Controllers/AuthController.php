<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(): Response
    {
        return response()
            ->view("user.login", [
                "title" => "Login"
            ]);
    }

    public function doLogin(Request $request)
    {
        $user = $request->input("user");
        $password = $request->input("password");

        if (empty($user) || empty($password)) {
            return response()->view("user.login", [
                "title" => "Login",
                "error" => "user or password is required"
            ]);
        }


        if ($this->userService->login($request)) {
            return redirect("/");
        }

        return response()->view("user.login", [
            "title" => "Login",
            "error" => "Failed Login User or Password /Nonactive"
        ]);
    }

    public function doLogout(Request $request)
    {
        $request->session()->forget("user");
        return redirect("/login");
    }
}
