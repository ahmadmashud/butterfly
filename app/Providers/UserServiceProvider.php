<?php

namespace App\Providers;

use App\Services\CategoryFoodDrinkService;
use App\Services\FoodDrinkService;
use App\Services\impl\CategoryFoodDrinkServiceImpl;
use App\Services\impl\FoodDrinkServiceImpl;
use App\Services\impl\KomisiGajiServiceImpl;
use App\Services\impl\LaporanServiceImpl;
use App\Services\impl\PackageRoomServiceImpl;
use App\Services\impl\PriceServiceImpl;
use App\Services\impl\RoleServiceImpl;
use App\Services\impl\SessionServiceImpl;
use App\Services\impl\SupplierServiceImpl;
use App\Services\impl\TransactionServiceImpl;
use App\Services\impl\UserServiceImpl;
use App\Services\KomisiGajiService;
use App\Services\LaporanService;
use App\Services\PackageRoomService;
use App\Services\PriceService;
use App\Services\RoleService;
use App\Services\SessionService;
use App\Services\SupplierService;
use App\Services\TransactionService;
use App\Services\UserService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        UserService::class => UserServiceImpl::class,
        CategoryFoodDrinkService::class => CategoryFoodDrinkServiceImpl::class,
        FoodDrinkService::class => FoodDrinkServiceImpl::class,
        SupplierService::class => SupplierServiceImpl::class,
        PackageRoomService::class => PackageRoomServiceImpl::class,
        SessionService::class => SessionServiceImpl::class,
        PriceService::class => PriceServiceImpl::class,
        RoleService::class => RoleServiceImpl::class,
        TransactionService::class => TransactionServiceImpl::class,
        LaporanService::class => LaporanServiceImpl::class,
        KomisiGajiService::class => KomisiGajiServiceImpl::class
    ];

    public  function provides(): array
    {
        return [
            UserService::class,
            CategoryFoodDrinkService::class,
            FoodDrinkService::class,
            SupplierService::class,
            PackageRoomService::class,
            SessionService::class,
            PriceService::class,
            RoleService::class,
            TransactionService::class,
            LaporanService::class,
            KomisiGajiService::class
        ];
    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . '/Helpers/File.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
