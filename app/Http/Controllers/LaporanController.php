<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Exports\LaporanFndExport;
use App\Helpers\HelperCustom;
use App\Services\LaporanService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{

    private LaporanService $laporanService;

    public function __construct(
        LaporanService $laporanService
    ) {
        $this->laporanService = $laporanService;
    }

    public function index(Request $request): Response
    {
        if (HelperCustom::isValidAccess('LAPORAN')) {

            return abort(401);
        }
        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');
        $data = $this->laporanService->get($tanggal_awal, $tanggal_akhir, $request->metode_pembayaran);
        return response()
            ->view('laporan.index', [
                'data' =>  $data,
                'tanggal_awal' => $tanggal_awal,
                'tanggal_akhir' =>  $tanggal_akhir,
                'metode_pembayaran' =>  $request->metode_pembayaran,
                'title' => 'Laporan'
            ]);
    }

    public function view_fnd(Request $request): Response
    {
        if (HelperCustom::isValidAccess('LAPORAN_FND')) {

            return abort(401);
        }
        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');

        $data = $this->laporanService->getFnd($tanggal_awal, $tanggal_akhir);
        return response()
            ->view('laporan.fnd.index', [
                'data' =>  $data,
                'tanggal_awal' => $tanggal_awal,
                'tanggal_akhir' =>  $tanggal_akhir,
                'title' => 'Laporan F&D'
            ]);
    }

    public function download_laporan(Request $request)
    {

        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');
        $data = $this->laporanService->get($tanggal_awal, $tanggal_akhir, $request->metode_pembayaran);
        return Excel::download(new LaporanExport($data), 'Laporan' . HelperCustom::formatDate($tanggal_awal) . 'sd' . HelperCustom::formatDate($tanggal_akhir)  . '.xlsx');
    }

    public function download_laporan_fnd(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');
        $data = $this->laporanService->getFnd($tanggal_awal, $tanggal_akhir);
        return Excel::download(new LaporanFndExport($data), 'Laporan_FND' . HelperCustom::formatDate($tanggal_awal) . 'sd' . HelperCustom::formatDate($tanggal_akhir)  . '.xlsx');
    }

    

    public function r(Request $request): Response
    {
        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');
        $data = $this->laporanService->get($tanggal_awal, $tanggal_akhir, $request->metode_pembayaran);
        return response()
            ->view('laporan.r.index_r', [
                'data' =>  $data,
                'tanggal_awal' => $tanggal_awal,
                'tanggal_akhir' =>  $tanggal_akhir,
                'metode_pembayaran' =>  $request->metode_pembayaran,
                'title' => 'Laporan'
            ]);
    }
}
