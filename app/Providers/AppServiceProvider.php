<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        \App\Models\User::observe(\App\Observers\UserObserver::class);
        \App\Models\Member::observe(\App\Observers\MemberObserver::class);

        \App\Models\Type::observe(\App\Observers\TypeObserver::class);
        \App\Models\Attribute::observe(\App\Observers\AttributeObserver::class);
        \App\Models\Product::observe(\App\Observers\ProductObserver::class);
        \App\Models\SKU::observe(\App\Observers\SKUObserver::class);
    }
}
