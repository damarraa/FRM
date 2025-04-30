<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        View::composer('*', function ($view) {
            $user = Auth::user();
            $role = $user ? $user->roles->first()->name ?? 'Tidak ada role' : 'Guest';
            
            $view->with(compact('user', 'role'));
        });

        ResetPassword::createUrlUsing(function (User $user, string $token) {
            return 'http://formreturmdu.prisan.co.id/reset-password/'.$token;
        });
    }
}
