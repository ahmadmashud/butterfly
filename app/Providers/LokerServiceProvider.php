<?php

namespace App\Providers;

use App\Services\impl\LokerServiceImpl;
use App\Services\LokerService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class LokerServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        LokerService::class => LokerServiceImpl::class
    ];

    public  function provides():array
    {
        return [LokerService::class];
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
