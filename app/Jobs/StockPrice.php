<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Company ;
use DB ;
class StockPrice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $value1 ;
    protected $value2 ;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        //
        // $this->value1 = $value1;
        // $this->value2 = $value2 ;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //dd("handle inside");
        $datas = Company::all();
        foreach($datas as $data)
        {
            $random_number = rand(400,600);
            $data->price = $random_number ;
            $data->save();
        }
        
        return "queue executed";
    }
}
