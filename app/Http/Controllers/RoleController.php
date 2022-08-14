<?php

namespace App\Http\Controllers;

use App\Helpers\HelperCustom;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{

    private RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index(): Response
    {
        if (HelperCustom::isValidAccess('M_ROLE')) {

            return abort(401);
        }
        $privilege = $this->roleService->getPrivilege();
        $role = $this->roleService->list();
        return response()
            ->view('role.index', [
                'data' =>  $role,
                'privileges' =>  $privilege,
                'title' => 'Role/Jabatan'
            ]);
    }

    public function get(Request $request, int $id)
    {
        $role = $this->roleService->get($id);
        return response()->json([
            'data' => $role
        ]);
    }

    public function add(Request $request)
    {
        $this->roleService->add($request);
        return redirect("/roles");
    }

    public function delete(Request $request, int $id)
    {
        $this->roleService->delete($id);
        return redirect("/roles");
    }

    public function edit(Request $request)
    {
        $this->roleService->edit($request);
        return redirect("/roles");
    }

    public function getPrivilege()
    {
        $privilege = $this->roleService->getPrivilege();
        return response()->json([
            'data' => $privilege
        ]);
    }

    public function addPrivilege(Request $request)
    {
        $this->roleService->addPrivilege($request);
        return redirect("/roles");
    }
}
