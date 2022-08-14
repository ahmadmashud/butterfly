<?php

namespace App\Services\impl;

use App\Models\Privilege;
use App\Models\Role;
use App\Models\RolePrivilege;
use Illuminate\Http\Request;
use App\Services\RoleService;

class RoleServiceImpl implements RoleService
{
    function list()
    {
        return Role::all();
    }

    function add(Request $request)
    {
        $role['code'] = $request->code;
        $role['nama'] = $request->nama;
        Role::create($role);
    }

    public function get(int $id)
    {
        return  Role::with(['privilege'])->where('id', $id)->firstOrFail();
    }

    public function delete(int $id)
    {
        $role =  Role::where('id', $id)->firstOrFail();
        $role->delete();
    }

    function edit(Request $request)
    {
        // get by id
        $role =  Role::where('id', $request->id)->firstOrFail();
        $role->code = $request->code;
        $role->nama = $request->nama;
        $role->save();
    }

    public function getPrivilege()
    {
        return  Privilege::all();
    }

    function addPrivilege(Request $request)
    {
        foreach ($request->privilege as $key => $value) {
            $role_privilege = RolePrivilege::firstOrNew(array('id_role' => $request->id, 'id_privilege' => $value));
            $role_privilege->id_role = $request->id;
            $role_privilege->id_privilege = $value;
            $role_privilege->save();
        }


       RolePrivilege::where('id_role', $request->id)->whereNotIn('id_privilege', $request->privilege)->delete();
    }
}
