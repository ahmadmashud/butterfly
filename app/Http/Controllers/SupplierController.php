<?php

namespace App\Http\Controllers;

use App\Helpers\HelperCustom;
use App\Services\SupplierService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SupplierController extends Controller
{

    private SupplierService $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function index(): Response
    {
        if (HelperCustom::isValidAccess('M_SUPPLIER')) {

            return abort(401);
        }
        $supplier = $this->supplierService->list();
        return response()
            ->view('supplier.index', [
                'data' =>  $supplier,
                'title' => 'Supplier'
            ]);
    }

    public function get(Request $request, int $id)
    {
        $supplier = $this->supplierService->get($id);
        return response()->json([
            'data' => $supplier
        ]);
    }

    public function delete(Request $request, int $id)
    {
        $this->supplierService->delete($id);
        return redirect("/suppliers");
    }

    public function edit(Request $request)
    {
        $this->supplierService->edit($request);
        return redirect("/suppliers");
    }
}
