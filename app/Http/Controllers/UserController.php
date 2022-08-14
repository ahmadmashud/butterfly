<?php

namespace App\Http\Controllers;

use App\Helpers\HelperCustom;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{

    private UserService $userService;
    private RoleService $roleService;

    public function __construct(UserService $userService,
    RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    public function index(): Response
    {
        if (HelperCustom::isValidAccess('M_USER')) {

            return abort(401);
        }
        $roles = $this->roleService->list();
        $users = $this->userService->list();
        return response()
            ->view('user.index', [
                'data' =>  $users,
                'roles' => $roles,
                'title' => 'Pengguna'
            ]);
    }

    public function get(Request $request, int $id)
    {
        $user = $this->userService->get($id);
        return response()->json([
            'data' => $user
        ]);
    }

    public function add(Request $request)
    {
        $this->userService->add($request);
        return redirect("/users");
    }

    public function delete(Request $request, int $id)
    {
        $this->userService->delete($id);
        return redirect("/users");
    }

    public function edit(Request $request)
    {
        $this->userService->edit($request);
        return redirect("/users");
    }
}
