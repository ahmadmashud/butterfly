<?php

namespace App\Http\Controllers;

use App\Helpers\HelperCustom;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{

    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(): Response
    {
        if (HelperCustom::isValidAccess('M_PRODUK')) {

            return abort(401);
        }
        $product = $this->productService->list();
        return response()
            ->view('product.index', [
                'data' =>  $product,
                'title' => 'Produk'
            ]);
    }

    public function get(Request $request, int $id)
    {
        $product = $this->productService->get($id);
        return response()->json([
            'data' => $product
        ]);
    }

    public function add(Request $request)
    {
        $this->productService->add($request);
        return redirect("/products");
    }

    public function delete(Request $request, int $id)
    {
        $this->productService->delete($id);
        return redirect("/products");
    }

    public function edit(Request $request)
    {
        $this->productService->edit($request);
        return redirect("/products");
    }
}
