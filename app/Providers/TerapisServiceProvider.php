<?php

namespace App\Providers;

use App\Services\impl\TerapisServiceImpl;
use App\Services\TerapisService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TerapisServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        TerapisService::class => TerapisServiceImpl::class
    ];

    public  function provides():array
    {
        return [TerapisService::class];
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
