<?php

namespace App\Services\impl;

use App\Models\KomisiSupplier;
use App\Models\KomisiTerapis;
use App\Models\KomisiUser;
use App\Services\KomisiGajiService;
use Illuminate\Support\Facades\DB;

class KomisiGajiServiceImpl implements KomisiGajiService
{
    function getUser($id, $tanggal_awal, $tanggal_akhir)
    {
        return KomisiUser::with(['user', 'transaction'])
            ->select(
                't_transactions.tanggal',
                't_komisi_users.id_user',
                'm_users.nama',
                'm_roles.nama as jabatan',
                DB::raw("COUNT(t_komisi_users.amount_km_produk) as total_produk"),
                DB::raw("SUM(t_komisi_users.amount_km_total) as fee_produk")
            )
            ->join('t_transactions', 't_transactions.id', '=', 't_komisi_users.id_trx')
            ->join('m_users', 'm_users.id', '=', 't_komisi_users.id_user')
            ->join('m_roles', 'm_roles.id', '=', 'm_users.role_id')
            ->where('m_users.id', $id)
            ->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])
            ->groupBy('id_user', 'nama', 'tanggal', 'jabatan')->orderBy('tanggal', 'desc')
            ->get();
    }

    function getTerapis($id, $tanggal_awal, $tanggal_akhir)
    {
        return KomisiTerapis::with(['terapis', 'transaction'])
            ->select(
                't_transactions.id_terapis',
                't_transactions.tanggal',
                'm_terapis.nama',
                'm_package_rooms.nama as nama_paket',
                DB::raw("SUM(t_komisi_terapis.sesi) as sesi"),
                DB::raw("SUM(t_komisi_terapis.amount_km_paket * t_komisi_terapis.sesi) as fee_sesi"),
                DB::raw("SUM(t_komisi_terapis.amount_km_produk) as komisi_terapis"),
                DB::raw("SUM(t_komisi_terapis.amount_km_total) as total")
            )
            ->join('t_transactions', 't_transactions.id', '=', 't_komisi_terapis.id_trx')
            ->join('m_terapis', 'm_terapis.id', '=', 't_komisi_terapis.id_terapis')
            ->join('m_package_rooms', 'm_package_rooms.id', '=', 't_transactions.id_paket')
            ->where('m_terapis.id', $id)
            ->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])
            ->groupBy('id_terapis', 'tanggal', 'nama', 'nama_paket')->orderBy('tanggal', 'desc')
            ->get()
            ->sortBy('nama');
    }


    function getSupplier($tanggal_awal, $tanggal_akhir)
    {
        $transaction = KomisiSupplier::with(['supplier', 'transaction'])
            ->join('t_transactions', 't_transactions.id', '=', 't_komisi_suppliers.id_trx')
            ->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])->get();

        // GROUPING
        $trx_groups = $transaction->map(function ($trx) {
            return [
                'id_supplier' => $trx->id_supplier,
                'tanggal' => $trx->transaction->tanggal,
                'nama' => $trx->supplier->nama,
                'sesi' => $trx->sesi,
                'total' => $trx->amount_km_total
            ];
        })->groupBy('tanggal');

        // SUM
        return $trx_groups->map(function ($group) {
            return [
                'id_supplier' => $group->first()['id_supplier'],
                'tanggal' => $group->first()['tanggal'],
                'nama' => $group->first()['nama'],
                'sesi' => $group->sum('sesi'),
                'total' => $group->sum('total')
            ];
        })->sortByDesc('tanggal');
    }
}