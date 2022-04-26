<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }

        Blade::if('architect', function () {
            return optional(auth()->user())->account_type === 'architect';
        });

        Blade::if('client', function () {
            return optional(auth()->user())->account_type === 'client';
        });

        Blade::if('admin', function () {
            return optional(auth()->user())->account_type === 'admin';
        });

        Blade::if('self', function ($id) {
            return $id && optional(auth())->id() === $id;
        });

        Blade::if('notself', function ($id) {
            return $id && optional(auth())->id() !== $id;
        });

        Blade::if('verified', function () {
            return optional(auth()->user())->hasVerifiedEmail();
        });

        Blade::if('unverified', function () {
            return !optional(auth()->user())->hasVerifiedEmail();
        });

        Blade::if('activated', function () {
            return optional(auth()->user())->hasVerifiedEmail() && optional(auth()->user())->prc_verified;
        });

        Blade::if('inactivated', function () {
            return !optional(auth()->user())->hasVerifiedEmail() || !optional(auth()->user())->prc_verified;
        });

        Blade::if('prc', function () {
            return optional(auth()->user())->prc_verified;
        });
    }
}
