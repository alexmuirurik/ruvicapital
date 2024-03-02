<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('create_contract', function(User $user){
            return $user->user_type === 'investor';
        });

        Gate::define('update_contract', function(User $user){
            return $user->user_type === 'super_admin';
        });

        Gate::define('create_deposit', function(User $user) {
            return $user->user_type === 'investor';
        });

        Gate::define('update_deposit', function(User $user) {
            return $user->user_type === 'super_admin';
        });

        Gate::define('create_earning', function(User $user){
            return $user->user_type === 'super_admin';
        });

        Gate::define('create_withdraw', function(User $user){
            return $user->user_type === 'investor';
        });

        Gate::define('update_withdraw', function(User $user){
            return $user->user_type === 'super_admin';
        });
    }
}
