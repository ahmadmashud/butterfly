<?php

namespace App\Services\impl;

use App\Models\Transaction;
use App\Models\Transaction2;
use App\Models\TransactionFoodDrink;
use App\Models\TransactionProduct;
use App\Services\LaporanService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanServiceImpl implements LaporanService
{
    function get($tanggal_awal, $tanggal_akhir, $metode_pembayaran)
    {
        $transaction = Transaction::with(['terapis', 'room', 'loker', 'produk', 'paket', 'payment'])
            ->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])
            ->orderBy('tanggal_masuk', 'desc')->get();


        if ($metode_pembayaran != null) {
            return  $transaction->filter(function ($trx) use ($metode_pembayaran) {
                if ($trx->payment == null) {
                    return false;
                }
                return in_array($trx->payment->metode_pembayaran, $metode_pembayaran);
            });
        }

        return $transaction;
    }

    function getFnd($tanggal_awal, $tanggal_akhir)
    {
        $data = TransactionFoodDrink::with(['foodDrink', 'transaction'])
            ->select(
                'm_category_food_drinks.nama as category',
                'm_food_drinks.code',
                'm_food_drinks.nama',
                'm_food_drinks.nama',
                't_transaction_food_drinks.price',
                DB::raw("SUM(t_transaction_food_drinks.qty) as qty"),
                DB::raw("SUM(t_transaction_food_drinks.total) as total")
            )
            ->join('t_transactions', 't_transactions.id', '=', 't_transaction_food_drinks.id_trx')
            ->join('m_food_drinks', 'm_food_drinks.id', '=', 't_transaction_food_drinks.id_food_drink')
            ->join('m_category_food_drinks', 'm_category_food_drinks.id', '=', 'm_food_drinks.id_category_food_drink')
            ->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])
            ->groupBy('nama', 'price', 'category', 'code')->orderBy('tanggal', 'desc')->get();

        return $data;
    }

    function getProducts($tanggal_awal, $tanggal_akhir)
    {
        return TransactionProduct::with(['product', 'transaction'])
            ->select(
                't_transactions.trx_no',
                'm_products.nama',
                't_transactions.tanggal',
                'm_products.nama',
                't_transaction_products.harga',
                DB::raw("SUM(t_transaction_products.qty) as qty"),
                DB::raw("SUM(t_transaction_products.total) as total")
            )
            ->join('t_transactions', 't_transactions.id', '=', 't_transaction_products.id_trx')
            ->join('m_products', 'm_products.id', '=', 't_transaction_products.id_produk')
            ->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])
            ->groupBy('trx_no', 'nama', 'tanggal', 'harga')->orderBy('tanggal', 'desc')->get();
    }

    function getProductsRekap($tanggal_awal, $tanggal_akhir)
    {
        return TransactionProduct::with(['product', 'transaction'])
            ->select(
                'm_products.code',
                'm_products.nama',
                't_transaction_products.harga',
                DB::raw("SUM(t_transaction_products.qty) as qty"),
                DB::raw("SUM(t_transaction_products.total) as total")
            )
            ->join('t_transactions', 't_transactions.id', '=', 't_transaction_products.id_trx')
            ->join('m_products', 'm_products.id', '=', 't_transaction_products.id_produk')
            ->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])
            ->groupBy( 'code','nama', 'harga')->orderBy('tanggal', 'desc')->get();
    }

    function  choose(Request $request)
    {
        foreach ($request->id as $key => $value) {
            $trx =  Transaction2::firstWhere('id', $value);
            if ($trx == null) {
                $item['id_trx'] =  $value;
                $item['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
                Transaction2::create($item);
            }
        };
    }
}
