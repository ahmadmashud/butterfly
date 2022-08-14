<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrivilegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $rooms =
            [[
                'code' => 'GALERI',
                'type' => 'MENU',
                'nama' => 'Menu Galeri',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'code' => 'TRX',
                'type' => 'MENU',
                'nama' => 'Menu Transaksi',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'code' => 'LAPORAN',
                'type' => 'MENU',
                'nama' => 'Menu Laporan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'code' => 'LAPORAN_FND',
                'type' => 'MENU',
                'nama' => 'Menu Laporan F&D',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'code' => 'KM_USER',
                'type' => 'MENU',
                'nama' => 'Menu Komisi Pengguna',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'code' => 'KM_TERAPIS',
                'type' => 'MENU',
                'nama' => 'Menu Komisi Terapis',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'code' => 'KM_SUPPLIER',
                'type' => 'MENU',
                'nama' => 'Menu Komisi Supplier',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'code' => 'M_PRODUK',
                'type' => 'MENU',
                'nama' => 'Menu Produk',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'code' => 'M_ROOM',
                'type' => 'MENU',
                'nama' => 'Menu Room',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'code' => 'M_LOKER',
                'type' => 'MENU',
                'nama' => 'Menu Loker',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'code' => 'M_TERAPIS',
                'type' => 'MENU',
                'nama' => 'Menu Terapis',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'code' => 'M_KATEGORI',
                'type' => 'MENU',
                'nama' => 'Menu Kategori',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'code' => 'M_FND',
                'type' => 'MENU',
                'nama' => 'Menu F&D',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'code' => 'M_SUPPLIER',
                'type' => 'MENU',
                'nama' => 'Menu Supplier',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'code' => 'M_PAKET',
                'type' => 'MENU',
                'nama' => 'Menu Paket Room',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'code' => 'M_SESI',
                'type' => 'MENU',
                'nama' => 'Menu Sesi',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'code' => 'M_TARIF',
                'type' => 'MENU',
                'nama' => 'Menu Tarif',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'code' => 'M_USER',
                'type' => 'MENU',
                'nama' => 'Menu Pengguna',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'code' => 'M_ROLE',
                'type' => 'MENU',
                'nama' => 'Menu Role/Jabatan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'code' => 'M_PRIVILEGE',
                'type' => 'MENU',
                'nama' => 'Menu Privilege',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'code' => 'CHANGE_DISCOUNT_TRX',
                'type' => 'ACTION',
                'nama' => 'Ubah Diskon Transaksi',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]];
        DB::table('m_privileges')->insert($rooms);
    }
}
