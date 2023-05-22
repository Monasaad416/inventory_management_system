<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
   

        Gate::define('founder', function(User $user) {
           return $user->roles_name == ["founder"];
        });

        Gate::define('shareholder', function(User $user) {
           return $user->roles_name == ["shareholder"];
        });

        Gate::define('client', function(User $user) {
           return $user->roles_name == ["client"];
        });

        Gate::define('supplier', function(User $user) {
           return $user->roles_name == ["supplier"];
        });


         Gate::define('admin', function(User $user) {
           return $user->roles_name == ["admin"];
        });
    }
}
