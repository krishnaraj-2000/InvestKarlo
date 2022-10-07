<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\InsertWalletAmountInterfaces;
use App\Services\UserWalletService ;
class InsertWalletAmount extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(InsertWalletAmountInterfaces::class , UserWalletService::class );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
