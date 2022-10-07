<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Company ;
class StockPriceChange extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change:stockprice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        dd('hello');
        $datas = Company::all();
        foreach($datas as $data)
        {
            $random_number = rand(400,600);
            $data->price = $random_number ;
            $data->save();
        }
        dump('executed');
        return ;
    }
}
