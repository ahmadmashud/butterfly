<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryFoodDrinkController;
use App\Http\Controllers\FoodDrinkController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KomisiGajiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\PackageRoomController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TerapisController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyGuestMiddleware;
use App\Http\Middleware\OnlyMemberMiddleware;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/linkstorage', function () {
    Artisan::call('storage:link'); // this will do the command line job
});


Route::view("/template", 'template');

// DASHBOARD
Route::get("/",  [HomeController::class, "home"]);

// AUTH
Route::controller(AuthController::class)->group(function () {
    Route::get("/login", "login")->middleware(OnlyGuestMiddleware::class);
    Route::post("/login", "doLogin")->middleware(OnlyGuestMiddleware::class);
    Route::post("/logout", "doLogout")->middleware(OnlyMemberMiddleware::class);
});

Route::controller(UserController::class)->group(function () {
    // LIST
    Route::get("/users", "index")->middleware(OnlyMemberMiddleware::class);
    // ADD
    Route::post("/users", "add")->middleware(OnlyMemberMiddleware::class);
    // DELETE
    Route::post("/users/{id}/delete", "delete")->middleware(OnlyMemberMiddleware::class);
    // GET
    Route::get("/users/{id}", "get")->middleware(OnlyMemberMiddleware::class);
    // EDIT    
    Route::post("/users/edit", "edit")->middleware(OnlyMemberMiddleware::class);
});

Route::controller(ProductController::class)->group(function () {
    // LIST
    Route::get("/products", "index")->middleware(OnlyMemberMiddleware::class);
    // ADD
    Route::post("/products", "add")->middleware(OnlyMemberMiddleware::class);
    // DELETE
    Route::post("/products/{id}/delete", "delete")->middleware(OnlyMemberMiddleware::class);
    // GET
    Route::get("/products/{id}", "get")->middleware(OnlyMemberMiddleware::class);
    // EDIT    
    Route::post("/products/edit", "edit")->middleware(OnlyMemberMiddleware::class);
});

Route::controller(RoomController::class)->group(function () {
    // LIST
    Route::get("/rooms", "index")->middleware(OnlyMemberMiddleware::class);
    // ADD
    Route::post("/rooms", "add")->middleware(OnlyMemberMiddleware::class);
    // DELETE
    Route::post("/rooms/{id}/delete", "delete")->middleware(OnlyMemberMiddleware::class);
    // GET
    Route::get("/rooms/{id}", "get")->middleware(OnlyMemberMiddleware::class);
    // EDIT    
    Route::post("/rooms/edit", "edit")->middleware(OnlyMemberMiddleware::class);
});

Route::controller(LokerController::class)->group(function () {
    // LIST
    Route::get("/lokers", "index")->middleware(OnlyMemberMiddleware::class);
    // ADD
    Route::post("/lokers", "add")->middleware(OnlyMemberMiddleware::class);
    // DELETE
    Route::post("/lokers/{id}/delete", "delete")->middleware(OnlyMemberMiddleware::class);
    // GET
    Route::get("/lokers/{id}", "get")->middleware(OnlyMemberMiddleware::class);
    // EDIT    
    Route::post("/lokers/edit", "edit")->middleware(OnlyMemberMiddleware::class);
});

Route::controller(TerapisController::class)->group(function () {
    // LIST
    Route::get("/terapis", "index")->middleware(OnlyMemberMiddleware::class);
    // ADD
    Route::post("/terapis", "add")->middleware(OnlyMemberMiddleware::class);
    // DELETE
    Route::post("/terapis/{id}/delete", "delete")->middleware(OnlyMemberMiddleware::class);
    // GET
    Route::get("/terapis/{id}", "get")->middleware(OnlyMemberMiddleware::class);
    // EDIT    
    Route::post("/terapis/edit", "edit")->middleware(OnlyMemberMiddleware::class);
    // GALLERY
    Route::get("/terapis/transaction/gallery", "gallery")->middleware(OnlyMemberMiddleware::class);
});


Route::controller(CategoryFoodDrinkController::class)->group(function () {
    // LIST
    Route::get("/categoryFoodDrinks", "index")->middleware(OnlyMemberMiddleware::class);
    // ADD
    Route::post("/categoryFoodDrinks", "add")->middleware(OnlyMemberMiddleware::class);
    // DELETE
    Route::post("/categoryFoodDrinks/{id}/delete", "delete")->middleware(OnlyMemberMiddleware::class);
    // GET
    Route::get("/categoryFoodDrinks/{id}", "get")->middleware(OnlyMemberMiddleware::class);
    // EDIT    
    Route::post("/categoryFoodDrinks/edit", "edit")->middleware(OnlyMemberMiddleware::class);
});


Route::controller(FoodDrinkController::class)->group(function () {
    // LIST
    Route::get("/foodDrinks", "index")->middleware(OnlyMemberMiddleware::class);
    // ADD
    Route::post("/foodDrinks", "add")->middleware(OnlyMemberMiddleware::class);
    // DELETE
    Route::post("/foodDrinks/{id}/delete", "delete")->middleware(OnlyMemberMiddleware::class);
    // GET
    Route::get("/foodDrinks/{id}", "get")->middleware(OnlyMemberMiddleware::class);
    // EDIT    
    Route::post("/foodDrinks/edit", "edit")->middleware(OnlyMemberMiddleware::class);
});


Route::controller(SupplierController::class)->group(function () {
    // LIST
    Route::get("/suppliers", "index")->middleware(OnlyMemberMiddleware::class);
    // GET
    Route::get("/suppliers/{id}", "get")->middleware(OnlyMemberMiddleware::class);
    // EDIT    
    Route::post("/suppliers/edit", "edit")->middleware(OnlyMemberMiddleware::class);
});

Route::controller(PackageRoomController::class)->group(function () {
    // LIST
    Route::get("/packageRooms", "index")->middleware(OnlyMemberMiddleware::class);
    // ADD
    Route::post("/packageRooms", "add")->middleware(OnlyMemberMiddleware::class);
    // DELETE
    Route::post("/packageRooms/{id}/delete", "delete")->middleware(OnlyMemberMiddleware::class);
    // GET
    Route::get("/packageRooms/{id}", "get")->middleware(OnlyMemberMiddleware::class);
    // EDIT    
    Route::post("/packageRooms/edit", "edit")->middleware(OnlyMemberMiddleware::class);
});

Route::controller(SessionController::class)->group(function () {
    // LIST
    Route::get("/sessions", "index")->middleware(OnlyMemberMiddleware::class);
    // GET
    Route::get("/sessions/{id}", "get")->middleware(OnlyMemberMiddleware::class);
    // EDIT    
    Route::post("/sessions/edit", "edit")->middleware(OnlyMemberMiddleware::class);
});

Route::controller(PriceController::class)->group(function () {
    // LIST
    Route::get("/prices", "index")->middleware(OnlyMemberMiddleware::class);
    // GET
    Route::get("/prices/{id}", "get")->middleware(OnlyMemberMiddleware::class);
    // EDIT    
    Route::post("/prices/edit", "edit")->middleware(OnlyMemberMiddleware::class);
});

Route::controller(TransactionController::class)->group(function () {
    // LIST
    // Route::get("/", "index")->middleware(OnlyMemberMiddleware::class);
    // HISTORY
    Route::get("/transactions/history", "history")->middleware(OnlyMemberMiddleware::class);
    // LIST
    Route::get("/transactions", "index")->middleware(OnlyMemberMiddleware::class);
    // ADD MENU
    Route::get("/transactions/add", "add")->middleware(OnlyMemberMiddleware::class);
    // ADD ACTION
    Route::post("/transactions/add", "addAction")->middleware(OnlyMemberMiddleware::class);
    // CANCEL
    Route::post("/transactions/cancel/{id}", "cancel")->middleware(OnlyMemberMiddleware::class);
    // STOP
    Route::post("/transactions/stop/{id}", "stop")->middleware(OnlyMemberMiddleware::class);
    // GET
    Route::get("/transactions/{id}", "get")->middleware(OnlyMemberMiddleware::class);
    // PAYMENT ACTION
    Route::post("/transactions/payment", "payment")->middleware(OnlyMemberMiddleware::class);
    // EDIT MENU
    Route::get("/transactions/edit/{id}", "edit")->middleware(OnlyMemberMiddleware::class);
    // EDIT ACTION
    Route::post("/transactions/edit/{id}", "editAction")->middleware(OnlyMemberMiddleware::class);
    // EDIT STATUS ACTION
    Route::get("/transactions/{id}/status/{status}", "editStatus")->middleware(OnlyMemberMiddleware::class);
});


Route::controller(RoleController::class)->group(function () {
    // LIST
    Route::get("/roles", "index")->middleware(OnlyMemberMiddleware::class);
    // ADD
    Route::post("/roles", "add")->middleware(OnlyMemberMiddleware::class);
    // DELETE
    Route::post("/roles/{id}/delete", "delete")->middleware(OnlyMemberMiddleware::class);
    // GET
    Route::get("/roles/{id}", "get")->middleware(OnlyMemberMiddleware::class);
    // EDIT    
    Route::post("/roles/edit", "edit")->middleware(OnlyMemberMiddleware::class);

    // SETTING AKSES
    Route::get("/roles/privilege", "getPrivilege")->middleware(OnlyMemberMiddleware::class);
    // ADD AKSES
    Route::post("/roles/privilege", "addPrivilege")->middleware(OnlyMemberMiddleware::class);
});


Route::controller(LaporanController::class)->group(function () {
    // MENU
    Route::get("/laporan", "index")->middleware(OnlyMemberMiddleware::class);
    // DOWNLOAD STRUK LAPORAN
    Route::get("/laporan/transaction/{id}/pdf", "generate_receipt")->middleware(OnlyMemberMiddleware::class);
    // MENU FND
    Route::get("/laporan/fnd", "view_fnd")->middleware(OnlyMemberMiddleware::class);
    // DOWNLOAD LAPORAN
    Route::get("/laporan/download", "download_laporan")->middleware(OnlyMemberMiddleware::class);
    // DOWNLOAD LAPORAN FND
    Route::get("/laporan/download/fnd", "download_laporan_fnd")->middleware(OnlyMemberMiddleware::class);

    Route::get("/laporan/products", "view_product")->middleware(OnlyMemberMiddleware::class);
    // DOWNLOAD LAPORAN PRODUK
    Route::get("/laporan/download/products", "download_laporan_products")->middleware(OnlyMemberMiddleware::class);

    // MENU R
    Route::get("/laporan/r", "r")->middleware(OnlyMemberMiddleware::class);
    Route::post("/laporan/r", "r_choose")->middleware(OnlyMemberMiddleware::class);
});


Route::controller(KomisiGajiController::class)->group(function () {
    // USER 
    Route::get("/komisi_gaji/user", "view_user")->middleware(OnlyMemberMiddleware::class);
    // USER DETAIL
    Route::get("/komisi_gaji/user/{id}", "view_user_detail")->middleware(OnlyMemberMiddleware::class);
    // TERAPIS 
    Route::get("/komisi_gaji/terapis", "view_terapis")->middleware(OnlyMemberMiddleware::class);
    // TERAPIS DETAIL
    Route::get("/komisi_gaji/terapis/{id}", "view_terapis_detail")->middleware(OnlyMemberMiddleware::class);
    // MENU FND
    Route::get("/komisi_gaji/supplier", "view_supplier")->middleware(OnlyMemberMiddleware::class);
});
