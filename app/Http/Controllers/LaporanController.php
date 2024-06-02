<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Exports\LaporanFndExport;
use App\Exports\LaporanProductExport;
use App\Helpers\HelperCustom;
use App\Services\KomisiGajiService;
use App\Services\LaporanService;
use App\Services\TransactionService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{

    private KomisiGajiService $komisiGajiService;
    private LaporanService $laporanService;

    public function __construct(
        KomisiGajiService $komisiGajiService,
        LaporanService $laporanService,
        TransactionService  $transactionService
    ) {
        $this->komisiGajiService = $komisiGajiService;
        $this->laporanService = $laporanService;
        $this->transactionService = $transactionService;
    }

    public function index(Request $request): Response
    {
        if (HelperCustom::isValidAccess('LAPORAN')) {

            return abort(401);
        }
        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');
        $data = $this->laporanService->getR($tanggal_awal, $tanggal_akhir, $request->metode_pembayaran)
            ->filter(function ($trx) {
                return $trx->payment != null;
            });
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

    public function print_laporan_excel(Request $request)
    {

        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');
        $data = $this->laporanService->getR($tanggal_awal, $tanggal_akhir, $request->metode_pembayaran)
            ->filter(function ($trx) {
                return $trx->payment != null;
            });
        return Excel::download(new LaporanExport($data), 'Laporan' . HelperCustom::formatDate($tanggal_awal) . 'sd' . HelperCustom::formatDate($tanggal_akhir)  . '.xlsx');
    }

    public function print_laporan_pdf(Request $request)
    {

        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');
        $data = $this->laporanService->getR($tanggal_awal, $tanggal_akhir, $request->metode_pembayaran)
            ->filter(function ($trx) {
                return $trx->payment != null;
            })->sortBy('tanggal');

        $total_cash = $data->filter(function ($trx) {
            return $trx->payment != null && $trx->payment->metode_pembayaran == 'CASH';
        })->map(function ($trx) {
            return $trx['amount_grand_total'];
        })->sum();

        $total_credit = $data->filter(function ($trx) {
            return $trx->payment != null && $trx->payment->metode_pembayaran == 'CREDIT';
        })->map(function ($trx) {
            return $trx['amount_grand_total'];
        })->sum();

        $total_credit_addtional = $data->filter(function ($trx) {
            return $trx->payment != null && $trx->payment->metode_pembayaran == 'CASH_CREDIT';
        })->map(function ($trx) {
            return $trx->payment->amount_credit;
        })->sum();

        $total_cash_addtional = $data->filter(function ($trx) {
            return $trx->payment != null && $trx->payment->metode_pembayaran == 'CASH_CREDIT';
        })->map(function ($trx) {
            return $trx->payment->amount_cash;
        })->sum();

        $total_foc = $data->filter(function ($trx) {
            return $trx->payment != null && $trx->payment->metode_pembayaran == 'FOC';
        })->map(function ($trx) {
            return $trx['amount_grand_total'];
        })->sum();

        $total_room = $data->map(function ($trx) {
            return $trx['amount_harga_paket'] * $trx['jumlah_sesi'];
        })->sum();

        $total_diskon = $data->map(function ($trx) {
            return $trx['amount_total_discount'];
        })->sum();


        $total_fnd = $data->map(function ($trx) {
            return $trx['amount_total_fnd'];
        })->sum();

        $total_harga_produk = $data->map(function ($trx) {
            return $trx['amount_harga_produk'];
        })->sum();

        $total_tax = $data->map(function ($trx) {
            return $trx['amount_total_pajak'];
        })->sum();

        $total_service = $data->map(function ($trx) {
            return $trx['amount_total_service_charge'];
        })->sum();

        $total_fee_terapis = $data->map(function ($trx) {
            if ($trx->komisi_terapis != null) {
                return $trx->komisi_terapis->amount_km_total;
            }
        })->sum();

        $data = [
            'data' => $data,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' =>  $tanggal_akhir,
            'total_cash' => $total_cash + $total_cash_addtional,
            'total_credit' => $total_credit + $total_credit_addtional,
            'total_foc' => $total_foc,
            'total_room' => $total_room,
            'total_diskon' => $total_diskon,
            'total_fnd' => $total_fnd,
            'total_harga_produk' => $total_harga_produk,
            'total_tax' => $total_tax,
            'total_service' => $total_service,
            'total_fee_terapis' => $total_fee_terapis

        ];
        $pdf = PDF::loadView('laporan.print.transaction', $data)->setPaper('a4', 'landscape');;

        return $pdf->stream('Laporan Transaksi.pdf');
    }

    public function print_laporan_fnd_excel(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');
        $data = $this->laporanService->getFnd($tanggal_awal, $tanggal_akhir);
        return Excel::download(new LaporanFndExport($data), 'Laporan_FND' . HelperCustom::formatDate($tanggal_awal) . 'sd' . HelperCustom::formatDate($tanggal_akhir)  . '.xlsx');
    }

    public function print_laporan_fnd_pdf(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');
        $data = $this->laporanService->getFnd($tanggal_awal, $tanggal_akhir)->groupBy('category')->toArray();

        $data = [
            'data' => $data,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' =>  $tanggal_akhir

        ];
        $pdf = PDF::loadView('laporan.print.fnd', $data);

        return $pdf->stream('Laporan FND.pdf');
    }


    public function r(Request $request): Response
    {
        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');
        $data = $this->laporanService->get($tanggal_awal, $tanggal_akhir, $request->metode_pembayaran)
        ->filter(function ($trx) {
            return $trx->payment != null;
        });
        return response()
            ->view('laporan.r.index_r', [
                'data' =>  $data,
                'tanggal_awal' => $tanggal_awal,
                'tanggal_akhir' =>  $tanggal_akhir,
                'metode_pembayaran' =>  $request->metode_pembayaran,
                'title' => 'Laporan'
            ]);
    }
    public function r_choose(Request $request)
    {
        $data = $this->laporanService->choose($request);
        return redirect("/laporan/r");
    }

    public function view_product(Request $request): Response
    {
        if (HelperCustom::isValidAccess('LAPORAN')) {

            return abort(401);
        }
        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');

        $data = $this->laporanService->getProducts($tanggal_awal, $tanggal_akhir);
        return response()
            ->view('laporan.product.index', [
                'data' =>  $data,
                'tanggal_awal' => $tanggal_awal,
                'tanggal_akhir' =>  $tanggal_akhir,
                'title' => 'Laporan Produk'
            ]);
    }

    public function print_laporan_products_excel(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');
        $data = $this->laporanService->getProducts($tanggal_awal, $tanggal_akhir);
        return Excel::download(new LaporanProductExport($data), 'Laporan_PRODUK' . HelperCustom::formatDate($tanggal_awal) . 'sd' . HelperCustom::formatDate($tanggal_akhir)  . '.xlsx');
    }


    public function print_laporan_products_pdf(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');
        $data = $this->laporanService->getProductsRekap($tanggal_awal, $tanggal_akhir);
        // dd($data);
        $data = [
            'data' => $data,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' =>  $tanggal_akhir

        ];
        $pdf = PDF::loadView('laporan.print.product', $data);

        return $pdf->stream('Laporan Product.pdf');
    }

    public function generate_receipt(int $id)
    {

        $transaction = $this->transactionService->get($id);
        $data = [
            'data' => $transaction
        ];
        $customPaper = array(0, 0, 967.00, 283.80);
        $pdf = PDF::loadView('laporan.print.receipt', $data)->setPaper($customPaper, 'landscape');;

        return $pdf->stream('testing.pdf');
    }

    public function print_r_laporan_pdf(Request $request)
    {

        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');
        $data = $this->laporanService->get($tanggal_awal, $tanggal_akhir, $request->metode_pembayaran)
            ->filter(function ($trx) {
                return $trx->payment != null;
            })->sortBy('trx_no');
            
        $total_cash = $data->filter(function ($trx) {
            return $trx->payment != null && $trx->payment->metode_pembayaran == 'CASH';
        })->map(function ($trx) {
            return $trx['amount_grand_total'];
        })->sum(); 

        $total_credit = $data->filter(function ($trx) {
            return $trx->payment != null && $trx->payment->metode_pembayaran == 'CREDIT';
        })->map(function ($trx) {
            return $trx['amount_grand_total'];
        })->sum();

        $total_credit_addtional = $data->filter(function ($trx) {
            return $trx->payment != null && $trx->payment->metode_pembayaran == 'CASH_CREDIT';
        })->map(function ($trx) {
            return $trx->payment->amount_credit;
        })->sum();

        $total_cash_addtional = $data->filter(function ($trx) {
            return $trx->payment != null && $trx->payment->metode_pembayaran == 'CASH_CREDIT';
        })->map(function ($trx) {
            return $trx->payment->amount_cash;
        })->sum();

        $total_foc = $data->filter(function ($trx) {
            return $trx->payment != null && $trx->payment->metode_pembayaran == 'FOC';
        })->map(function ($trx) {
            return $trx['amount_grand_total'];
        })->sum();

        $total_cancel = $data->filter(function ($trx) {
            return $trx->payment != null && $trx->payment->metode_pembayaran == 'CANCEL';
        })->map(function ($trx) {
            return $trx['amount_grand_total'];
        })->sum();


        // calculate not canceled trx
        $data_not_canceled = $data->filter(function ($trx) {
            return $trx->payment->metode_pembayaran != 'CANCEL';
        });

        $total_room = $data_not_canceled->map(function ($trx) {
            return $trx['amount_harga_paket'] * $trx['jumlah_sesi'];
        })->sum();

        $total_diskon = $data_not_canceled->map(function ($trx) {
            return $trx['amount_total_discount'];
        })->sum();

        $total_fnd = $data_not_canceled->map(function ($trx) {
            return $trx['amount_total_fnd'];
        })->sum();

        $total_harga_produk = $data_not_canceled->map(function ($trx) {
            return $trx['amount_harga_produk'];
        })->sum();

        $total_tax = $data_not_canceled->map(function ($trx) {
            return $trx['amount_total_pajak'];
        })->sum();

        $total_service = $data_not_canceled->map(function ($trx) {
            return $trx['amount_total_service_charge'];
        })->sum();

        $komisi_terapis = $this->komisiGajiService->getRekapTerapis($tanggal_awal, $tanggal_akhir);

        $total_fee_terapis = $komisi_terapis->values()->map(function ($trx) {
            return $trx->map(function ($komisi) {
                return $komisi->total;
            })->sum();
        })->sum();
        ini_set('max_execution_time', 500);
        $data = [
            'data' => $data,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' =>  $tanggal_akhir,
            'total_cash' => $total_cash + $total_cash_addtional,
            'total_credit' => $total_credit + $total_credit_addtional,
            'total_foc' => $total_foc,
            'total_cancel'=> $total_cancel,
            'total_room' => $total_room,
            'total_diskon' => $total_diskon,
            'total_fnd' => $total_fnd,
            'total_harga_produk' => $total_harga_produk,
            'total_tax' => $total_tax,
            'total_service' => $total_service,
            'total_fee_terapis' => $total_fee_terapis

        ];
        $pdf = PDF::loadView('laporan.print.transaction', $data)->setPaper('a4', 'landscape');;

        return $pdf->stream('Laporan Transaksi.pdf');
    }


    public function print_r_laporan_pdf_v2(Request $request)
    {

        $tanggal_awal = $request->tanggal_awal != null ? $request->tanggal_awal : date('Y-m-01');
        $tanggal_akhir = $request->tanggal_akhir != null ? $request->tanggal_akhir :  date('Y-m-t');
        $data = $this->laporanService->get($tanggal_awal, $tanggal_akhir, $request->metode_pembayaran)
            ->filter(function ($trx) {
                return $trx->payment != null;
            })->sortBy('trx_no');
            
        $total_cash = $data->filter(function ($trx) {
            return $trx->payment != null && $trx->payment->metode_pembayaran == 'CASH';
        })->map(function ($trx) {
            return $trx['amount_grand_total'];
        })->sum(); 

        $total_credit = $data->filter(function ($trx) {
            return $trx->payment != null && $trx->payment->metode_pembayaran == 'CREDIT';
        })->map(function ($trx) {
            return $trx['amount_grand_total'];
        })->sum();

        $total_credit_addtional = $data->filter(function ($trx) {
            return $trx->payment != null && $trx->payment->metode_pembayaran == 'CASH_CREDIT';
        })->map(function ($trx) {
            return $trx->payment->amount_credit;
        })->sum();

        $total_cash_addtional = $data->filter(function ($trx) {
            return $trx->payment != null && $trx->payment->metode_pembayaran == 'CASH_CREDIT';
        })->map(function ($trx) {
            return $trx->payment->amount_cash;
        })->sum();

        $total_foc = $data->filter(function ($trx) {
            return $trx->payment != null && $trx->payment->metode_pembayaran == 'FOC';
        })->map(function ($trx) {
            return $trx['amount_grand_total'];
        })->sum();

        $total_cancel = $data->filter(function ($trx) {
            return $trx->payment != null && $trx->payment->metode_pembayaran == 'CANCEL';
        })->map(function ($trx) {
            return $trx['amount_grand_total'];
        })->sum();


        // calculate not canceled trx
        $data_not_canceled = $data->filter(function ($trx) {
            return $trx->payment->metode_pembayaran != 'CANCEL';
        });

        $total_room = $data_not_canceled->map(function ($trx) {
            return $trx['amount_harga_paket'] * $trx['jumlah_sesi'];
        })->sum();

        $total_diskon = $data_not_canceled->map(function ($trx) {
            return $trx['amount_total_discount'];
        })->sum();

        $total_fnd = $data_not_canceled->map(function ($trx) {
            return $trx['amount_total_fnd'];
        })->sum();

        $total_harga_produk = $data_not_canceled->map(function ($trx) {
            return $trx['amount_harga_produk'];
        })->sum();

        $total_tax = $data_not_canceled->map(function ($trx) {
            return $trx['amount_total_pajak'];
        })->sum();

        $total_service = $data_not_canceled->map(function ($trx) {
            return $trx['amount_total_service_charge'];
        })->sum();

        $komisi_terapis = $this->komisiGajiService->getRekapTerapis($tanggal_awal, $tanggal_akhir);

        $total_fee_terapis = $komisi_terapis->values()->map(function ($trx) {
            return $trx->map(function ($komisi) {
                return $komisi->total;
            })->sum();
        })->sum();
        $data = [
            'data' => $data,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' =>  $tanggal_akhir,
            'total_cash' => $total_cash + $total_cash_addtional,
            'total_credit' => $total_credit + $total_credit_addtional,
            'total_foc' => $total_foc,
            'total_cancel'=> $total_cancel,
            'total_room' => $total_room,
            'total_diskon' => $total_diskon,
            'total_fnd' => $total_fnd,
            'total_harga_produk' => $total_harga_produk,
            'total_tax' => $total_tax,
            'total_service' => $total_service,
            'total_fee_terapis' => $total_fee_terapis

        ];
        return view('laporan.print.transactionV2', $data);
    }
}
