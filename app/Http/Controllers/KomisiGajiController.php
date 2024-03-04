<?php

namespace App\Http\Controllers;

use App\Helpers\HelperCustom;
use App\Services\KomisiGajiService;
use App\Services\TerapisService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class KomisiGajiController extends Controller
{

    private KomisiGajiService $komisiGajiService;
    private UserService $userService;
    private TerapisService $terapisService;

    public function __construct(
        KomisiGajiService $komisiGajiService,
        UserService $userService,
        TerapisService $terapisService
    ) {
        $this->komisiGajiService = $komisiGajiService;
        $this->userService = $userService;
        $this->terapisService = $terapisService;
    }
    public function view_user(Request $request): Response
    {
        if (HelperCustom::isValidAccess('KM_USER')) {

            return abort(401);
        }
        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');
        $data = $this->komisiGajiService->getRekapUser($tanggal_awal, $tanggal_akhir);
        return response()
            ->view('komisiGaji.index_user', [
                'data' =>   $data,
                'tanggal_awal' => $tanggal_awal,
                'tanggal_akhir' =>  $tanggal_akhir,
                'title' => 'Komisi Pengguna'
            ]);
    }


    public function view_user_detail(Request $request): Response
    {
        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');

        $data = $this->komisiGajiService->getUser($request->id, $tanggal_awal, $tanggal_akhir);
        $total = $data->map(function ($trx) {
            return $trx['fee_produk'];
        })->sum();
        return response()
            ->view('komisiGaji.user', [
                'data' =>   $data,
                'tanggal_awal' => $tanggal_awal,
                'tanggal_akhir' =>  $tanggal_akhir,
                'id' => $request->id,
                'total' => $total,
                'title' => 'Komisi Pengguna'
            ]);
    }

    public function view_terapis(): Response
    {
        if (HelperCustom::isValidAccess('KM_TERAPIS')) {

            return abort(401);
        }
        $tanggal_awal =  date('Y-m-01');
        $tanggal_akhir =  date('Y-m-t');
        $data = $this->terapisService->list();
        return response()
            ->view('komisiGaji.index_terapis', [
                'data' =>   $data,
                'title' => 'Komisi & Gaji Terapis',
                'tanggal_awal' => $tanggal_awal,
                'tanggal_akhir' =>  $tanggal_akhir,
            ]);
    }

    public function view_terapis_detail(Request $request): Response
    {
        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');

        $data = $this->komisiGajiService->getTerapis($request->id, $tanggal_awal, $tanggal_akhir);
        $total = $data->map(function ($trx) {
            return $trx['total'];
        })->sum();
        return response()
            ->view('komisiGaji.terapis', [
                'data' =>   $data,
                'id' => $request->id,
                'tanggal_awal' => $tanggal_awal,
                'tanggal_akhir' =>  $tanggal_akhir,
                'total' => $total,
                'title' => 'Komisi & Gaji Terapis'
            ]);
    }

    public function view_terapis_detail_produk(Request $request)
    {
        $data = $this->komisiGajiService->getTerapisTrxProduk($request->ids);
       return response()->json([
            $data->values()
        ]);
    }


    public function view_supplier(Request $request): Response
    {
        if (HelperCustom::isValidAccess('KM_SUPPLIER')) {

            return abort(401);
        }
        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');

        $data = $this->komisiGajiService->getSupplier($tanggal_awal, $tanggal_akhir);
        $total = $data->map(function ($trx) {
            return $trx['total'];
        })->sum();
        return response()
            ->view('komisiGaji.supplier', [
                'data' =>   $data,
                'tanggal_awal' => $tanggal_awal,
                'tanggal_akhir' =>  $tanggal_akhir,
                'total' => $total,
                'title' => 'Komisi Supplier'
            ]);
    }

    public function print_rekap_terapis(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');
        $data = $this->komisiGajiService->getRekapTerapis($tanggal_awal, $tanggal_akhir);
        $data = [
            'data' => $data,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' =>  $tanggal_akhir

        ];
        $pdf = PDF::loadView('komisiGaji.print.terapis', $data);

        return $pdf->stream('komisi terapis.pdf');
    }


    public function print_supplier(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');
        $data = $this->komisiGajiService->getSupplier($tanggal_awal, $tanggal_akhir);
        $total = $data->map(function ($trx) {
            return $trx['total'];
        })->sum();
        $sesi = $data->map(function ($trx) {
            return $trx['sesi'];
        })->sum();

        $data = [
            'data' => $data,
            'sesi'=> $sesi,
            'total' => $total,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' =>  $tanggal_akhir

        ];
        $pdf = PDF::loadView('komisiGaji.print.supplier', $data);

        return $pdf->stream('komisi Supplier.pdf');
    }

    public function print_rekap_user(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');
        $data = $this->komisiGajiService->getRekapUser($tanggal_awal, $tanggal_akhir);
        $data = [
            'data' => $data,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' =>  $tanggal_akhir

        ];
        $pdf = PDF::loadView('komisiGaji.print.user', $data);

        return $pdf->stream('komisi Produk Pengguna.pdf');
    }
}
