<?php

namespace App\Http\Controllers;

use App\Helpers\HelperCustom;
use App\Services\TerapisService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TerapisController extends Controller
{

    private TerapisService $terapisService;

    public function __construct(TerapisService $terapisService)
    {
        $this->terapisService = $terapisService;
    }

    public function index(): Response
    {
        if (HelperCustom::isValidAccess('M_TERAPIS')) {

            return abort(401);
        }
        $terapis = $this->terapisService->list();
        return response()
            ->view('terapis.index', [
                'data' =>  $terapis,
                'title' => 'Terapis'
            ]);
    }

    public function gallery(): Response
    {

        if (HelperCustom::isValidAccess('GALERI')) {

            return abort(401);
        }

        $terapis  = DB::table('m_terapis')
            ->leftJoin('t_transactions', function ($join) {
                $join->on('m_terapis.id', '=', 't_transactions.id_terapis');
                $join->on('t_transactions.status', '=', DB::raw("'ACCEPTED'"));
            })
            ->select(
                'm_terapis.*',
                't_transactions.status as trx_status',
                't_transactions.tanggal_keluar'
            )
            ->get();
        return response()
            ->view('terapis.gallery', [
                'data' =>  $terapis,
                'title' => 'Galeri'
            ]);
    }

    public function get(Request $request, int $id)
    {
        $terapis = $this->terapisService->get($id);
        return response()->json([
            'data' => $terapis
        ]);
    }

    public function add(Request $request)
    {
        $this->terapisService->add($request);
        return redirect("/terapis");
    }

    public function delete(Request $request, int $id)
    {
        $this->terapisService->delete($id);
        return redirect("/terapis");
    }

    public function edit(Request $request)
    {
        $this->terapisService->edit($request);
        return redirect("/terapis");
    }
}
