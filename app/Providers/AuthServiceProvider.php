<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
	    $this->registerPolicies();

        Gate::define('czo', function(User $user) {
            return auth()->user()->rola_id == 1;
        });

        Gate::define('admin', function (User $user) {
            return auth()->user()->rola_id == 1 || auth()->user()->rola_id == 3 || auth()->user()->rola_id == 4;
        });

        Gate::define('uljr', function (User $user) {
            return auth()->user()->rola_id == 1 || auth()->user()->rola_id == 3;
        });

        Gate::define('pregled', function (User $user) {
            return auth()->user()->rola_id == 1 || auth()->user()->rola_id == 2 || auth()->user()->rola_id == 3;
        });
    }
}
