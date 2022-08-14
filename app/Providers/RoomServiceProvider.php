<?php

namespace App\Providers;

use App\Services\impl\RoomServiceImpl;
use App\Services\RoomService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class RoomServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        RoomService::class => RoomServiceImpl::class
    ];

    public  function provides():array
    {
        return [RoomService::class];
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
