<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Models\User; // Also ensure User model is imported
//use App\Providers\Schema;


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
        Validator::extend('user_id', function ($attribute, $value, $parameters, $validator) {
            return User::where('user_id', $value)->exists();
        });
    
        Validator::replacer('user_id', function ($message, $attribute, $rule, $parameters) {
            return "The selected user ID is invalid.";
        });

       // Schema::defaultStringLength(191);
    }
}
