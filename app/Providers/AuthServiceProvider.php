<?php

namespace App\Providers;

use App\Route;
use App\Policies\RoutePolicy;
use App\RouteShare;
use App\BoxShare;
use App\Box;
use App\Policies\BoxPolicy;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Box::class => BoxPolicy::class,
        BoxShare::class => BoxSharePolicy::class,
        Route::class => RoutePolicy::class,
        RouteShare::class => RouteShare::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        //
    }
}
