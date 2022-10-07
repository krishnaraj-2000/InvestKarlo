<?php
namespace App\Services;
use App\Models\UserWallet ;
use App\Interfaces\InsertWalletAmountInterfaces ;
use DB ;
use App\Events\UserWalletDeposit ;
class UserWalletService implements InsertWalletAmountInterfaces
{
    public function store_wallet($user_id , $wallet_amount )
    {
        // insert the data to db 
        $user_wallet = UserWallet::where('user_id',$user_id)->first();
        $previous_balance = $user_wallet->wallet_amount ;
        if($user_wallet)
        {
            UserWallet::where('user_id',$user_id )->update(['wallet_amount' => $user_wallet->wallet_amount + $wallet_amount ]);
        }
        else 
        {
            $store_wallet = new UserWallet ;
            $store_wallet->user_id = $user_id ;
            $store_wallet->wallet_amount = $wallet_amount ;
            $store_wallet->save();
        }
        $get_wallet_info = UserWallet::where('user_id',$user_id)->first();
        $current_balance = $get_wallet_info->wallet_amount ;
        $user_id = $user_wallet->user_id ;
        event(new UserWalletDeposit($previous_balance ,$current_balance , $user_id ) );
        //return "Amount Deposited" ;
    }
}

?>