<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePrivilegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role_privileges = [[
            'id_role' => 3,
            'id_privilege' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'id_role' => 3,
            'id_privilege' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'id_role' => 3,
            'id_privilege' => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'id_role' => 3,
            'id_privilege' => 4,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'id_role' => 3,
            'id_privilege' => 5,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'id_role' => 3,
            'id_privilege' => 6,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'id_role' => 3,
            'id_privilege' => 7,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'id_role' => 3,
            'id_privilege' => 8,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'id_role' => 3,
            'id_privilege' => 9,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'id_role' => 3,
            'id_privilege' => 10,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'id_role' => 3,
            'id_privilege' => 11,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'id_role' => 3,
            'id_privilege' => 12,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'id_role' => 3,
            'id_privilege' => 13,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'id_role' => 3,
            'id_privilege' => 14,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'id_role' => 3,
            'id_privilege' => 15,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'id_role' => 3,
            'id_privilege' => 16,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'id_role' => 3,
            'id_privilege' => 17,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'id_role' => 3,
            'id_privilege' => 18,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'id_role' => 3,
            'id_privilege' => 19,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'id_role' => 3,
            'id_privilege' => 20,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], [
            'id_role' => 3,
            'id_privilege' => 21,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]];

        DB::table('m_role_privileges')->insert($role_privileges);
    }
}
