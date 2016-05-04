<?php

namespace App\Providers;

use App\Route;
use App\Policies\RoutePolicy;
use App\BoxShare;
use App\Policies\BoxSharePolicy;

use App\BoxPermission;
use App\Policies\BoxPermissionPolicy;

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
        BoxPermission::class => BoxPermissionPolicy::class,
        BoxShare::class => BoxSharePolicy::class,
        Route::class => RoutePolicy::class,
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
