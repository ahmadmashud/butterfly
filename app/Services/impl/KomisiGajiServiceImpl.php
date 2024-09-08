<?php

namespace App\Services\impl;

use App\Models\KomisiSupplier;
use App\Models\KomisiTerapis;
use App\Models\KomisiUser;
use App\Models\TransactionProduct;
use App\Models\Terapis;
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
                DB::raw("SUM(t_komisi_terapis.amount_km_total) as total"),
                DB::raw("GROUP_CONCAT(t_transactions.id SEPARATOR ',') as ids ")
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

    function getTerapisTrxProduk($list_id_trx)
    {
       $result = TransactionProduct::with(['transaction','product'])
            ->select(
                'm_products.id',
                'm_products.nama',
                DB::raw("SUM(t_transaction_products.qty) as qty "),
                't_transaction_products.harga',
                DB::raw("SUM(t_transaction_products.total) as total ")
            )
            ->join('m_products', 'm_products.id', '=', 't_transaction_products.id_produk')
            ->whereIn('t_transaction_products.id_trx' , explode(",",$list_id_trx))
            ->groupBy('m_products.id', 'nama','harga')
            ->get()
            ->sortBy('nama');
            return $result;
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
                DB::raw("SUM(t_transactions.qty_pdk) as qty_pdk"),
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
    
    function getListTerapisTrxProduk($tanggal_awal, $tanggal_akhir)
    {
       $result = TransactionProduct::with(['transaction','product'])
            ->select(
                't_transactions.id_terapis',
                'm_products.nama',
                DB::raw("SUM(t_transaction_products.qty) as qty "),
                't_transaction_products.harga',
                DB::raw("SUM(t_transaction_products.total) as total ")
            )
            ->join('t_transactions', 't_transactions.id', '=', 't_transaction_products.id_trx')
            ->join('m_products', 't_transaction_products.id_produk', '=', 'm_products.id')
            ->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])
            ->groupBy('t_transactions.id_terapis', 'm_products.nama','t_transaction_products.harga')
            ->get()
            ->sortBy('m_products.nama');

            $distinctIdTerapis = $result->pluck('id_terapis')->unique()->values()->toArray();
            $terapisData = Terapis::whereIn('id', $distinctIdTerapis)
                                ->get(['id', 'nama', 'code']) // Fetch id, nama, and code
                                ->keyBy('id') // Use id as the key for the array
                                ->map(function ($terapis) {
                                    return [
                                        'nama' => $terapis->nama,
                                        'code' => $terapis->code
                                    ];
                                })
                                ->toArray();
            $groupedData = $result->groupBy(function ($item) {
                return $item->id_terapis;
            });
        
            $finalResult = $groupedData->map(function ($items, $id_terapis) use ($terapisData) {
                return [
                    'terapis_code' => $terapisData[$id_terapis]['code'],
                    'terapis_name' => $terapisData[$id_terapis]['nama'],
                    'transactions' => $items
                ];
            });
       
            return $finalResult;
    }
}
