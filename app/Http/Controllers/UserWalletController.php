<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\InsertWalletAmountInterfaces ;
class UserWalletController extends Controller
{
    //
    protected $store_value ;
    public function __construct(InsertWalletAmountInterfaces $store_value)
    {
        $this->store_value = $store_value ; 
    }

    public function index(Request $request)
    {
        //dd($request->input('amount'));
         $result = $this->store_value->store_wallet($request->input('user_id') , $request->input('amount') ) ;
      // $result = $this->store_value->store_wallet() ; 
        return $result ; 
    }
}
