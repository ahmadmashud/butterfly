<?php

namespace App\Services\impl;

use App\Helpers\HelperCustom;
use App\Models\FoodDrink;
use App\Models\KomisiSupplier;
use App\Models\KomisiTerapis;
use App\Models\KomisiUser;
use App\Models\Loker;
use App\Models\Payment;
use App\Models\Price;
use App\Models\Room;
use App\Models\Sequence;
use App\Models\Terapis;
use App\Models\Transaction;
use App\Models\TransactionFoodDrink;
use App\Models\User;
use App\Services\TransactionService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionServiceImpl implements TransactionService
{

    function list()
    {
        return Transaction::all();
    }

    function add(Request $request)
    {

        DB::beginTransaction();

        try {
            // save trx
            $transaction = $this->toModelTransaction($request);
            $transaction =  Transaction::create($transaction);
            $transaction->save();

            // save trx fnd if exists fnd
            if ($request->id_fnd != null) {
                $fnd = $this->toModelFnd($request, $transaction->id);
                DB::table('t_transaction_food_drinks')->insert($fnd);
            }

            // update flag in terapis
            $terapis = Terapis::where('id', $request->terapis)->firstOrFail();
            $terapis->status = 'PROGRESING';
            $terapis->save();

            // update flag in room
            $room = Room::where('id', $request->room)->firstOrFail();
            $room->is_used = true;
            $room->save();

            // update flag in loker
            $loker = Loker::where('id', $request->loker)->firstOrFail();
            $loker->is_used = true;
            $loker->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            // todo redirect to error page
            return redirect()
                ->route('user.index')
                ->with('warning', 'Something Went Wrong!');
        }
    }

    function cancel(int $id)
    {

        DB::beginTransaction();
        try {
            $transaction =  Transaction::where('id', $id)->firstOrFail();
            $transaction['status'] = 'CANCEL';
            $transaction->save();

            // update flag in terapis
            $terapis = Terapis::where('id', $transaction->id_terapis)->firstOrFail();
            $terapis->status = 'AVAILABLE';
            $terapis->save();

            // update flag in room
            $room = Room::where('id', $transaction->id_room)->firstOrFail();
            $room->is_used = false;
            $room->save();

            // update flag in loker
            $loker = Loker::where('id', $transaction->id_loker)->firstOrFail();
            $loker->is_used = false;
            $loker->save();

            // set cancel in payment
            $payment['id_transaction'] = $transaction->id;
            $payment['metode_pembayaran'] = 'CANCEL';
            $payment['amount_cash'] = 0;
            $payment['amount_credit'] = 0;
            $payment['amount_total'] = 0;
            $payment =  Payment::create($payment);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            // todo redirect to error page
            return redirect()
                ->route('user.index')
                ->with('warning', 'Something Went Wrong!');
        }
    }

    function stop(int $id)
    {
        DB::beginTransaction();
        try {
            $transaction =  Transaction::where('id', $id)->firstOrFail();
            $transaction['status'] = 'FINISHED';
            $transaction->save();

            // update flag in terapis
            $terapis = Terapis::where('id', $transaction->id_terapis)->firstOrFail();
            $terapis->status = 'AVAILABLE';
            $terapis->save();

            // update flag in room
            $room = Room::where('id', $transaction->id_room)->firstOrFail();
            $room->is_used = false;
            $room->save();

            // update flag in loker
            $loker = Loker::where('id', $transaction->id_loker)->firstOrFail();
            $loker->is_used = false;
            $loker->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            // todo redirect to error page
            return redirect()
                ->route('user.index')
                ->with('warning', 'Something Went Wrong!');
        }
    }

    function payment(Request $request)
    {

        DB::beginTransaction();
        try {
            $transaction =  Transaction::where('id', $request->id)->firstOrFail();
            // if cancel then don update status to PAID
            $transaction['status'] = $request->metode_pembayaran != 'CANCEL' ? 'PAID' : 'CANCEL';
            $transaction->save();

            $payment['id_transaction'] = $transaction->id;
            $payment['metode_pembayaran'] = $request->metode_pembayaran;
            $payment['no_rek'] = $request->no_rek;
            $payment['nama'] = $request->nama;
            $payment['amount_cash'] = $request->cash == null ? 0 : $request->cash;
            $payment['amount_credit'] = $request->credit == null ? 0 : $request->credit;
            $payment['amount_total'] = $payment['amount_cash'] + $payment['amount_credit'];
            $payment =  Payment::create($payment);
            //calculate KOMISI
            if ($request->metode_pembayaran != 'CANCEL') {
                $this->generateKomisiTerapis($transaction);
                $this->generateKomisiSupplier($transaction);
                $this->generateKomisiSales($transaction);
                $this->generateKomisiUser($transaction);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }
    }

    function generateKomisiTerapis(Transaction $transaction)
    {
        $komisi['id_trx'] = $transaction->id;
        $komisi['id_terapis'] = $transaction->id_terapis;
        $komisi['amount_km_paket'] = $transaction->paket->km_terapis;
        $komisi['amount_km_produk'] = $transaction->produk->km_terapis;
        $komisi['sesi'] = $transaction->jumlah_sesi;
        $komisi['amount_km_total'] = $komisi['amount_km_paket'] *  $komisi['sesi'] + $komisi['amount_km_produk'];
        KomisiTerapis::create($komisi);
    }

    function generateKomisiSupplier(Transaction $transaction)
    {
        $komisi['id_trx'] = $transaction->id;
        $komisi['id_supplier'] = $transaction->id_supplier;
        $komisi['amount_km_paket'] = $transaction->paket->km_supplier;
        $komisi['sesi'] = $transaction->jumlah_sesi;
        $komisi['amount_km_total'] = $komisi['amount_km_paket'] *  $komisi['sesi'];
        KomisiSupplier::create($komisi);
    }

    function generateKomisiSales(Transaction $transaction)
    {
        $user = User::where('id', $transaction->id_sales)->firstOrFail();
        $komisi['id_trx'] = $transaction->id;
        $komisi['id_user'] = $transaction->id_sales;
        $komisi['role_id'] = $user->role_id;
        $komisi['amount_km_produk'] = $transaction->produk->km_gro;
        $komisi['amount_km_total'] = $komisi['amount_km_produk'];
        KomisiUser::create($komisi);
    }

    function generateKomisiUser(Transaction $transaction)
    {
        // get users except GRO, cz GRO get comision if selected in menu trx
        $users = User::with(['role'])->where('is_active', true)->get()
            ->filter(function ($user) {
                return $user->role->code != 'GRO';
            });

        $users->each(function ($user) use ($transaction) {
            $komisi['id_trx'] = $transaction->id;
            $komisi['id_user'] = $user->id;
            $komisi['role_id'] = $user->role_id;
            $komisi_amount = 0;
            if ($user->role->code == 'STAFF') {
                $komisi_amount  = $transaction->produk->km_staff;
            } else if ($user->role->code == 'SPV') {
                $komisi_amount  = $transaction->produk->km_spv;
            }
            $komisi['amount_km_produk'] = $komisi_amount;
            $komisi['amount_km_total'] = $komisi['amount_km_produk'];
            KomisiUser::create($komisi);
        });
    }

    function toModelFnd(Request $request, $id)
    {
        $list_fnd = new Collection();
        for ($i = 0; $i < count($request->id_fnd); $i++) {
            $price = HelperCustom::unformatNumber($request->price[$i]);
            $qty = HelperCustom::unformatNumber($request->qty[$i]);
            $total = $price * $qty;
            $data =  [
                'id_food_drink' => $request->id_fnd[$i],
                'id_trx' =>  $id,
                'qty' =>  $qty,
                'price' => $price,
                'total' => $total,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];
            $list_fnd->push($data);
        }

        // reduce stock in fNd
        $food_drink_masters = FoodDrink::whereIn('id',  $request->id_fnd)->get();
        $list_fnd->each(function ($trx) use ($food_drink_masters) {
            $food_drink = $food_drink_masters->firstWhere('id', $trx['id_food_drink']);
            $food_drink['stock'] = $food_drink['stock'] - $trx['qty'];
            $food_drink->save();
        });

        return $list_fnd->toArray();
    }

    function toModelTransaction(Request $request)
    {

        // set tanggal masuk & keluar
        $tanggal_masuk = Carbon::now();
        $tanggal_keluar = Carbon::now()->addMinutes($request->durasi);
        $transaction['tanggal_masuk'] = $tanggal_masuk;
        $transaction['tanggal_keluar'] = $tanggal_keluar;

        // set trx no
        $transaction['trx_no'] = $this->generateTrxNo($request);

        $transaction['status'] = 'ACCEPTED';
        $transaction['id_loker'] = $request->loker;
        $transaction['nama_pelanggan'] = $request->nama_pelanggan;
        $transaction['id_room'] = $request->room;
        $transaction['tanggal'] = $request->date;
        $transaction['jumlah_sesi'] = $request->jumlah_sesi;
        $transaction['durasi'] = $request->durasi;
        $transaction['id_paket'] = $request->paket;
        $transaction['id_produk'] = $request->produk;
        $transaction['id_terapis'] = $request->terapis;
        $transaction['id_sales'] = $request->id_sales;
        $transaction['id_supplier'] = 1; // todo still hardcode -> get from table
        $transaction['amount_harga_paket'] = HelperCustom::unformatNumber($request->harga_room);
        $transaction['amount_discount'] = HelperCustom::unformatNumber($request->discount);
        $transaction['amount_total_discount'] = HelperCustom::unformatNumber($request->total_discount);
        $transaction['discount_sesi_ke'] = $request->discount_sesi_ke;
        $transaction['amount_harga_paket_setelah_diskon'] = HelperCustom::unformatNumber($request->total_harga_room);
        $transaction['amount_harga_produk'] = HelperCustom::unformatNumber($request->total_harga_produk);
        $transaction['amount_total_fnd'] = HelperCustom::unformatNumber($request->total_fnd);
        $transaction['amount_total'] = HelperCustom::unformatNumber($request->total);
        $transaction['amount_total_service_charge'] = HelperCustom::unformatNumber($request->total_service_charge);
        $transaction['amount_service_charge'] = HelperCustom::unformatNumber($request->service_charge);
        $transaction['amount_grand_total'] = HelperCustom::unformatNumber($request->grand_total);

        $ketentuan_pajak = Price::where('type', 'PAJAK')->firstOrFail()->nilai;
        $transaction['pajak_term'] =  $ketentuan_pajak / 100;
        $transaction['amount_total_pajak'] =  $transaction['amount_total'] * $transaction['pajak_term'];

        return $transaction;
    }

    function generateTrxNo()
    {
        $prefix = Carbon::now()->format('ymd');
        $sequence = Sequence::where('prefix', $prefix)->first();
        if ($sequence != null) {
            $sequence['value'] = $sequence->value + 1;
        } else {
            $sequence = new Sequence();
            $sequence['prefix'] = $prefix;
            $sequence['value'] = 1;
        }
        $sequence->save();
        $trx_no = HelperCustom::generateTrxNo($prefix, $sequence['value']);
        return $trx_no;
    }

    public function get(int $id)
    {
        return  Transaction::with(['terapis', 'room', 'loker', 'produk', 'paket'])->where('id', $id)->firstOrFail();
    }

    public function delete(int $id)
    {
        $transaction =  Transaction::where('id', $id)->firstOrFail();
        $transaction->delete();
    }

    public function edit(Request $request, int $id)
    {

        DB::beginTransaction();
        try {
            // edit trx
            $transaction =  $this->toEditTrx($request, $id);
            $transaction->save();

            // edit trx fnd if exists
            $this->handlingEditFnd($request, $id);

            // update flag in terapis if change
            $id_terapis_old =  $transaction['id_terapis'];
            $id_terapis_new =  $request->terapis;
            if ($id_terapis_new != $id_terapis_old) {
                $terapis_old = Terapis::where('id', $id_terapis_old)->firstOrFail();
                $terapis_old->status = 'AVAILABLE';
                $terapis_old->save();

                $terapis_new = Terapis::where('id', $id_terapis_new)->firstOrFail();
                $terapis_new->status = 'BOOK';
                $terapis_new->save();
            }

            // update flag in room if change
            $id_room_old =  $transaction['id_room'];
            $id_room_new =  $request->room;
            if ($id_room_new != $id_room_old) {
                $room_old = Room::where('id', $$id_room_old)->firstOrFail();
                $room_old->is_used = false;
                $room_old->save();

                $room_new = Room::where('id', $id_room_new)->firstOrFail();
                $room_new->is_used = false;
                $room_new->save();
            }

            // update flag in loker
            $id_loker_old =  $transaction['id_loker'];
            $id_loker_new =  $request->loker;
            if ($id_loker_new != $id_loker_new) {
                $loker_old = Loker::where('id', $$id_loker_old)->firstOrFail();
                $loker_old->is_used = false;
                $loker_old->save();

                $loker_new = Room::where('id', $id_loker_new)->firstOrFail();
                $loker_new->is_used = false;
                $loker_new->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // todo redirect to error page
            dd($e);
            return redirect()
                ->route('user.index')
                ->with('warning', 'Something Went Wrong!');
        }
    }

    function toEditTrx(Request $request, int $id)
    {
        $transaction = Transaction::where('id', $id)->firstOrFail();
        // set tanggal masuk & keluar
        $tanggal_masuk =  $transaction['tanggal_masuk'];
        $tanggal_keluar = Carbon::parse($tanggal_masuk)->addMinutes($request->durasi);
        $transaction['tanggal_masuk'] = $tanggal_masuk;
        $transaction['tanggal_keluar'] = $tanggal_keluar;

        $transaction['id_loker'] = $request->loker;
        $transaction['nama_pelanggan'] = $request->nama_pelanggan;
        $transaction['id_room'] = $request->room;
        $transaction['tanggal'] = $request->date;
        $transaction['jumlah_sesi'] = $request->jumlah_sesi;
        $transaction['durasi'] = $request->durasi;
        $transaction['id_paket'] = $request->paket;
        $transaction['id_produk'] = $request->produk;
        $transaction['id_terapis'] = $request->terapis;
        $transaction['id_sales'] = $request->id_sales;
        $transaction['id_supplier'] = 1; // todo still hardcode -> get from table
        $transaction['amount_harga_paket'] = HelperCustom::unformatNumber($request->harga_room);
        $transaction['amount_discount'] = HelperCustom::unformatNumber($request->discount);
        $transaction['amount_total_discount'] = HelperCustom::unformatNumber($request->total_discount);
        $transaction['discount_sesi_ke'] = $request->discount_sesi_ke;
        $transaction['amount_harga_paket_setelah_diskon'] = HelperCustom::unformatNumber($request->total_harga_room);
        $transaction['amount_harga_produk'] = HelperCustom::unformatNumber($request->total_harga_produk);
        $transaction['amount_total_fnd'] = HelperCustom::unformatNumber($request->total_fnd);
        $transaction['amount_total'] = HelperCustom::unformatNumber($request->total);
        $transaction['amount_total_service_charge'] = HelperCustom::unformatNumber($request->total_service_charge);
        $transaction['amount_service_charge'] = HelperCustom::unformatNumber($request->service_charge);
        $transaction['amount_grand_total'] = HelperCustom::unformatNumber($request->grand_total);

        $ketentuan_pajak = Price::where('type', 'PAJAK')->firstOrFail()->nilai;
        $transaction['pajak_term'] =  $ketentuan_pajak / 100;
        $transaction['amount_total_pajak'] =  $transaction['amount_total'] * $transaction['pajak_term'];

        return $transaction;
    }

    function handlingEditFnd($request, $id)
    {
        $transaction_fnd = TransactionFoodDrink::where('id_trx', $id)->get();
        // request to collection
        $req_fnd_collection = collect([]);
        $req_fnd = isset($request->id_fnd) ? $request->id_fnd : array();
        for ($i = 0; $i < count($req_fnd); $i++) {
            $fnd_req = [
                'id' => isset($request->id_t_fnd[$i]) ? $request->id_t_fnd[$i] : null,
                'id_food_drink' => $request->id_fnd[$i],
                'price' => HelperCustom::unformatNumber($request->price[$i]),
                'qty' => $request->qty[$i],
                'total' =>  $request->qty[$i] * HelperCustom::unformatNumber($request->price[$i])
            ];
            $req_fnd_collection->push($fnd_req);
        }

        // rollback stock in Food drink from all trx fnd
        $food_drink_from_trx = $transaction_fnd->map(function ($item) {
            return $item->id_food_drink;
        });
        $food_drink_ids = array_merge($req_fnd, $food_drink_from_trx->toArray());
        $food_drink_masters = FoodDrink::whereIn('id',  $food_drink_ids)->get();
        $transaction_fnd->each(function ($trx) use ($food_drink_masters) {
            $food_drink = $food_drink_masters->firstWhere('id', $trx->id_food_drink);
            $food_drink['stock'] = $food_drink['stock'] + $trx->qty;
            $food_drink->save();
        });

        // insert or update in fnd trx
        $list_fnd_trx = $req_fnd_collection->each(function ($item) use ($transaction_fnd, $id) {
            $fnd_trx =  $transaction_fnd->firstWhere('id', $item['id']);
            if ($fnd_trx != null) {
                $fnd_trx['price'] = $item['price'];
                $fnd_trx['qty'] = $item['qty'];
                $fnd_trx['total'] = $item['total'];
                $fnd_trx->save();
            } else {
                $item['id_trx'] = $id;
                $item['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
                TransactionFoodDrink::create($item);
            }
        });


        // reduce stock in fnd
        $list_fnd_trx->each(function ($trx) use ($food_drink_masters) {
            $food_drink =  $food_drink_masters->firstWhere('id', $trx['id_food_drink']);
            $trx_qty = $trx != null ? $trx['qty'] : 0;
            $food_drink['stock'] = $food_drink['stock'] -  $trx_qty;
            $food_drink->save();
        });

        // delete not send data from FE
        $transaction_fnd->whereNotIn('id', $request->id_t_fnd)->each(function ($trx) {
            $trx->delete();
        });
    }

    function editStatus(Request $request)
    {
        DB::beginTransaction();
        try {
            $transaction =  Transaction::where('id', $request->id)->firstOrFail();
            $terapis = Terapis::where('id', $transaction->id_terapis)->firstOrFail();
            $to_status = $request->status;
            Log::info($to_status);
            Log::info($request->id);
            if ($to_status == 'FINISHING') {
                Log::info('masuk');
                // ONLY STATUS TERAPIS
                $terapis['status'] = $to_status;
                $terapis->save();
            } else if ($to_status == 'AVAILABLE') {
                Log::info('masuk 2');
                // STOP TRX
                $transaction['status'] = 'FINISHED';
                $transaction->save();

                // update flag in terapis
                $terapis->status = 'AVAILABLE';
                $terapis->save();

                // update flag in room
                $room = Room::where('id', $transaction->id_room)->firstOrFail();
                $room->is_used = false;
                $room->save();
                // update flag in loker
                $loker = Loker::where('id', $transaction->id_loker)->firstOrFail();
                $loker->is_used = false;
                $loker->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            // todo redirect to error page
            return redirect()
                ->route('user.index')
                ->with('warning', 'Something Went Wrong!');
        }
    }
}
