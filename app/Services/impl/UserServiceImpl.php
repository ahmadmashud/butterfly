<?php

namespace App\Services\impl;

use App\Helpers\HelperCustom;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserServiceImpl implements UserService
{
    function login(Request $request): bool
    {
        $username = $request->input("user");
        $password = $request->input("password");
        $result = User::with(['role' => function ($role) {
            $role->with(['privilege' => function ($priv_role) {
                $priv_role->with('privilege');
            }]);
        }])->firstWhere(['username' => $username]);
        if ($result != null && $password == $result->password && $result->is_active) {
            // set user info
            $request->session()->put("user", $result);
            
            // set privileges
            $privileges = $result->role->privilege->map(function ($privilege) {
                return $privilege->privilege->code;
            })->toArray();

            $request->session()->put('privileges', $privileges);

            return true;
        } else {
            // dd($result != null && $password == $result->password && $result->is_active);
            return false;
        }
        // return   $result != null && Hash::check($password, $result->password);
    }

    function list()
    {
        return  User::all();
    }

    function add(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:100',
            'username' => 'required',
            'tanggal_join' => 'required',
            'password' => 'required'
        ]);

        $user['nama'] = $request->nama;
        $user['username'] = $request->username;
        $user['password'] = $request->password;
        $user['tanggal_join'] = $request->tanggal_join;
        $user['role_id'] = $request->role_id;
        $user['is_active'] = true;

        $user = User::create($user);
        $user['code'] = HelperCustom::generateTrxNo('US', $user->id);
        $user->save();
    }

    public function get(int $id)
    {
        return  User::where('id', $id)->firstOrFail();
    }

    public function delete(int $id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $user->delete();
    }

    function edit(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:100',
            'username' => 'required',
            'tanggal_join' => 'required'
        ]);
        // get by id
        $user = User::where('id', $request->id)->firstOrFail();
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->tanggal_join = $request->tanggal_join;
        $user->role_id = $request->role_id;
        $user->is_active = $request->is_active == "on" ? true : false;
        if ($request->password != null && $request->password != "") {
            $user->password = $request->password;
        }

        $user->save();
    }
}
