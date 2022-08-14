<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles =
            [[
                'code' => 'GRO',
                'nama' => 'Gro',
                'is_default' => true,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'code' => 'STAFF',
                'nama' => 'Staff',
                'is_default' => true,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], [
                'code' => 'SPV',
                'nama' => 'Supervisor',
                'is_default' => true,
                'is_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]];
        DB::table('m_roles')->insert($roles);
    }
}
