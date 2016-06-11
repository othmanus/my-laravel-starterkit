<?php

namespace App\Providers;

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
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

        // routes that should be accessed by administrators only
        $gate->define('administer', function($user, $model) {
            return $user->role == "administrator";
        });

        // routes that should be accessed by moderators only
        $gate->define('moderate', function($user, $model) {
            return in_array($user->role, ["administrator", "moderator"]);
        });

    }
}
