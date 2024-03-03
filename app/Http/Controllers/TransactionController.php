<?php

namespace App\Http\Controllers;

use App\Helpers\HelperCustom;
use App\Services\FoodDrinkService;
use App\Services\LokerService;
use App\Services\PackageRoomService;
use App\Services\PriceService;
use App\Services\ProductService;
use App\Services\RoomService;
use App\Services\SessionService;
use App\Services\TerapisService;
use App\Services\TransactionService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionController extends Controller
{

    private TransactionService $transactionService;

    private LokerService $lokerService;

    private RoomService $roomService;

    private SessionService $sessionService;

    private FoodDrinkService $foodDrinkService;

    private UserService $userService;

    private PriceService $priceService;

    public function __construct(
        TransactionService $transactionService,
        LokerService $lokerService,
        RoomService $roomService,
        PackageRoomService $packageRoomService,
        ProductService $productService,
        TerapisService $terapisService,
        SessionService $sessionService,
        FoodDrinkService $foodDrinkService,
        UserService $userService,
        PriceService $priceService
    ) {
        $this->transactionService = $transactionService;
        $this->lokerService = $lokerService;
        $this->roomService = $roomService;
        $this->packageRoomService = $packageRoomService;
        $this->productService = $productService;
        $this->terapisService = $terapisService;
        $this->sessionService = $sessionService;
        $this->foodDrinkService = $foodDrinkService;
        $this->userService = $userService;
        $this->priceService = $priceService;
    }

    public function index(): Response
    {
        // if (HelperCustom::isValidAccess('TRX')) {

        //     return abort(401);
        // }
        $lokers = $this->lokerService->list()->filter(function ($value, $key) {
            return $value->is_active;
        });
        $transaction = $this->transactionService->list()->filter(function ($value, $key) {
            return !in_array($value->status, array('PAID', 'CANCEL'));
        })->sortBy('tanggal_masuk')->sortDesc();

        return response()
            ->view('transaction.index', [
                'data' =>  $transaction,
                'lokers' =>  $lokers,
                'title' => 'Transaksi'
            ]);
    }

    public function add(): Response
    {
        if (HelperCustom::isValidAccess('TRX')) {

            return abort(401);
        }
        $lokers = $this->lokerService->list()->filter(function ($value, $key) {
            return !$value->is_used && $value->is_active;
        });

        $rooms = $this->roomService->list()->filter(function ($value, $key) {
            return !$value->is_used && $value->is_active;
        });

        // todo add active flag
        $packages = $this->packageRoomService->list()->filter(function ($value, $key) {
            return $value->is_active;
        });

        $products = $this->productService->list()->filter(function ($value, $key) {
            return $value->is_active;
        });

        $terapis = $this->terapisService->list()->filter(function ($value, $key) {
            return $value->status == 'AVAILABLE' || $value->status == 'BOOK'  && $value->is_active;
        });

        $users = $this->userService->list()->filter(function ($value, $key) {
            return $value->role->code == 'GRO';
        });

        $session = $this->sessionService->list()->firstOrFail();

        $foodDrinks = $this->foodDrinkService->list()->filter(function ($value, $key) {
            return $value->stock > 0 && $value->is_active;
        });;

        $prices = $this->priceService->list()->firstWhere('type', 'SERVICE_CHARGE');

        return response()
            ->view('transaction.add', [
                'lokers' => $lokers,
                'rooms' => $rooms,
                'packages' => $packages,
                'products' => $products,
                'terapis' => $terapis,
                'session' => $session,
                'prices' => $prices,
                'foodDrinks' => $foodDrinks,
                'sales' => $users,
                'title' => 'Transaksi'
            ]);
    }

    public function addAction(Request $request)
    {
        $this->transactionService->add($request);
        return redirect("/transactions");
    }

    public function cancel(Request $request, int $id)
    {
        $this->transactionService->cancel($id);
        return redirect("/transactions");
    }

    public function stop(Request $request, int $id)
    {
        $this->transactionService->stop($id);
        return redirect("/transactions");
    }

    public function payment(Request $request)
    {
        $this->transactionService->payment($request);
        return redirect("/transactions");
    }

    public function get(Request $request, int $id)
    {
        $transaction = $this->transactionService->get($id);
        return response()->json([
            'data' => $transaction
        ]);
    }


    public function delete(Request $request, int $id)
    {
        $this->transactionService->delete($id);
        return redirect("/transactions");
    }

    public function edit(int $id): Response
    {
        // get trx   
        $transaction = $this->transactionService->get($id);

        $id_loker = $transaction->id_loker;
        $lokers = $this->lokerService->list()->filter(function ($value, $key) use ($id_loker) {
            return !$value->is_used && $value->is_active || $value->id == $id_loker;
        });

        $id_room = $transaction->id_room;
        $rooms = $this->roomService->list()->filter(function ($value, $key) use ($id_room) {
            return !$value->is_used && $value->is_active || $value->id == $id_room;
        });

        // todo add active flag
        $packages = $this->packageRoomService->list()->filter(function ($value, $key) {
            return $value->is_active;
        });

        $products = $this->productService->list()->filter(function ($value, $key) {
            return $value->is_active;
        });

        $id_terapis = $transaction->id_terapis;
        $terapis = $this->terapisService->list()->filter(function ($value, $key) use ($id_terapis) {
            return $value->status == 'AVAILABLE' && $value->is_active || $value->id == $id_terapis;
        });

        $users = $this->userService->list()->filter(function ($value, $key) {
            return $value->role->code == 'GRO';
        });

        $session = $this->sessionService->list()->firstOrFail();

        $foodDrinks = $this->foodDrinkService->list()->filter(function ($value, $key) {
            return $value->stock > 0 && $value->is_active;
        });;

        $prices = $this->priceService->list()->firstWhere('type', 'SERVICE_CHARGE');
        return response()
            ->view('transaction.edit', [
                'data' => $transaction,
                'lokers' => $lokers,
                'rooms' => $rooms,
                'packages' => $packages,
                'products' => $products,
                'terapis' => $terapis,
                'session' => $session,
                'prices' => $prices,
                'foodDrinks' => $foodDrinks,
                'sales' => $users,
                'title' => 'Edit Transaksi'
            ]);
    }

    public function editAction(Request $request, int $id)
    {
        $this->transactionService->edit($request, $id);
        return redirect("/transactions");
    }

    public function history(): Response
    {
        $transaction = $this->transactionService->list()->filter(function ($value, $key) {
            return $value->status == 'PAID';
        });
        return response()
            ->view('transaction.history', [
                'data' =>  $transaction,
                'title' => 'Riwayat Transaksi'
            ]);
    }
    
    public function editStatus(Request $request)
    {
        $this->transactionService->editStatus($request);
        return response()->json([
            'data' => true
        ]);
    }
    
    public function rollback(int $id)
    {
        $this->transactionService->rollback($id);
        return redirect("/transactions");
    }
}
