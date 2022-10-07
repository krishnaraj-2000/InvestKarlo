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

        //print_r($event->email);
        # Include the Autoloader (see "Libraries" for install instructions)
        
        # Instantiate the client.
        // $mgClient = new Mailgun('53014eee9e6af271cda0da45cb09b301-78651cec-d355f9ca');
        // $domain = "sandbox6b8fd3755987436c81393641d84d6f5b.mailgun.org";
        // # Make the call to the client.
        // $result = $mgClient->sendMessage($domain, array(
        //     'from'	=> 'Excited User <kyadav75676@sandbox6b8fd3755987436c81393641d84d6f5b.mailgun.org>',
        //     'to'	=> 'Baz <krishnay.75676@gmail.com>',
        //     'subject' => 'Hello',
        //     'text'	=> 'Testing some Mailgun awesomness!'
        // ));
        //echo ".. mail send ";
        
    }
}
