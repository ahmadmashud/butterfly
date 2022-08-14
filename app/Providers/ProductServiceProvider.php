<?php

namespace App\Providers;

use App\Services\impl\ProductServiceImpl;
use App\Services\ProductService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        ProductService::class => ProductServiceImpl::class
    ];

    public  function provides():array
    {
        return [ProductService::class];
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
