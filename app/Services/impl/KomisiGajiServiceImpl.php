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

    function getRekapTerapis($tanggal_awal, $tanggal_akhir)
    {
        $trx = KomisiTerapis::with(['terapis', 'transaction'])
            ->select(
                'm_terapis.code',
                't_transactions.id_terapis',
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
            ->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])
            ->groupBy('id_terapis', 'nama', 'nama_paket', 'code')->orderBy('code', 'asc')
            ->get()
            ->sortBy('code');


        // GROUPING
        return $trx->groupBy('nama');
    }

    function getRekapUser($tanggal_awal, $tanggal_akhir)
    {

        $data = DB::select(DB::raw("select
        mu.nama sales,
        mu.code ,
        sum(ttp.qty) as qty ,
        sum(tku.amount_km_gro) as gro ,
        sum(tku.amount_km_spv) as manager ,
        sum(tku.amount_km_staff) as staff
    from
        t_komisi_users tku
    inner join t_transactions tt 
    on
        tku.id_trx = tt.id
    inner join (
        select
            ttp.id_trx,
            tt.id_sales,
            sum(ttp.qty) as qty
        from
            t_transaction_products ttp
        inner join t_transactions tt on
            ttp.id_trx = tt.id
        where
            tt.tanggal between '$tanggal_awal' and '$tanggal_akhir'
		AND tt.status = 'PAID'
        group by
            ttp.id_trx,
            tt.id_sales) ttp 
    on
        tt.id = ttp.id_trx
        AND tt.id_sales = ttp.id_sales
    inner join m_users mu on
        mu.id = tt.id_sales
    where
            tt.tanggal between '$tanggal_awal' and '$tanggal_akhir'
		AND tt.status = 'PAID'
    group by
        sales,
        code
    order by
        code;"));

        $data_groups = collect($data)->groupBy('sales');

        return $data_groups->map(function ($group) {
            return [
                'code' => $group->first()->code,
                'sales' => $group->first()->sales,
                'qty' => $group->sum('qty'),
                'manager' => $group->sum('manager'),
                'gro' => $group->sum('gro'),
                'staff' => $group->sum('staff')
            ];
        })->sortBy('code');
    }
}
