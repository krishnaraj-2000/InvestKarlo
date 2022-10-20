<?php

namespace App\Listeners;

use App\Events\UserWalletDeposit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
//require 'vendor/autoload.php';
use Mailgun\Mailgun;
use App\Models\UserWalletHistory ;
class UserWalletDepositNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserWalletDeposit  $event
     * @return void
     */
    public function handle(UserWalletDeposit $event)
    {
        
        $user_wallet_history = new UserWalletHistory ;
        $user_wallet_history->user_id = $event->user_id ;
        $user_wallet_history->previous_balance = $event->previous_balance ;
        $user_wallet_history->current_balance = $event->current_balance ;
        $user_wallet_history->save();
        print_r('wallet credited and history updated ');
        exit;

        
    }
}
