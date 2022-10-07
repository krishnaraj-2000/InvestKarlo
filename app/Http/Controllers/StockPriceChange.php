<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\StockPrice ;
use App\Models\Company ;

class StockPriceChange extends Controller
{
    //
    public function price_change(Request $request)
    {
        // Create post here ..
        //dd('price change');
        StockPrice::dispatch();
        return "Cron executed";
    }
    
    //CreateApplication::dispatch($value, $value1, $value2, $value3)->onQueue('processing');
}
