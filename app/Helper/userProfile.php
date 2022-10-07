<?php

namespace App\Helper ;
use Illuminate\Support\Facades\Auth ;
use App\Models\User ;
class userProfile
{
    public static function userDetail($email)
    {
        $user = User::where('email' ,$email )->first();
        if($user)
        {
            return $user ;
        }
        else 
        {
            return null ;
        }
    }

}