<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserWallet;
use App\Models\WalletStatus ;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        WalletStatus::factory()->count(5)->create();

        // $seed_user_wallet = new UserWallet ;
        // $seed_user_wallet->user_id = 15 ;
        // $seed_user_wallet->wallet_amount = 500;
        // $seed_user_wallet->save(); 
        // UserWallet::factory()
        //     ->count(10)
        //     ->hasPosts(1)
        //     ->create();
    }
}
