<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Database\Eloquent\Model\Company;
//use Illuminate\Database\Eloquent\Model\MutualFunds;
use App\Models\MutualFunds;
use App\Models\Company;
use App\Models\companyMutualFunds;
use Illuminate\Support\Arr;
use DB;
use Log;
//use Exception;
class MutualFundsController extends Controller
{
    //
    
    public function customCreateMutualFunds(Request $request )
    {
        DB::beginTransaction();
        try
        {
            $check = false ;
            $mutual_funds = new MutualFunds();
            $mutual_funds->fund_name = $request->input('fund_name');
            $mutual_funds->aum = $request->input('aum');
            $mutual_funds->fund_manager = $request->input('fund_manager');
            $mutual_funds->saveOrFail();

            if($check)
            {
                DB::commit() ;
                return "Mutual fund saved";
            }
            else 
            {
                throw new \Exception('mutual fund cannot be saved');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return response()->json(['error' => $e->getMessage() ,'status' => 500 ] );
        }

        // ** Alternate way to add to db **
        // $data = request->all(); 
       // ** 1st method **
        // $result = User::create( [ 
        //     'name' => $data['name'] ,
        //     'email' => $data['email'] ,
        //     'password' => Hash::make($data['password'])
        //  ]  );
        //** 2nd method **
        // $mutual_funds = new MutualFunds();
        // $mutual_funds->fund_name = $request->input('fund_name');
        // $mutual_funds->aum = $request->input('aum');
        // $mutual_funds->fund_manager = $request->input('fund_manager');
        // $mutual_funds->save();

        // $createData = [
        //     'fund_name' => $request->input('fund_name'),
        //     'aum' => $request->input('aum'),
        //     'fund_manager' => $request->input('fund_manager'),
        // ];

        //DB::connection()->enableQueryLog();

        // DB::table('mutual_funds')->insert($createData); // Query Builder 
        //dd(Company::query()->find([1])->toSql());
        //$queries = DB::getQueryLog();
        //Log::info($queries);

        //return "Mutual fund added successfully";


        
    }
     
    public function companyStore(Request $request)
    {
        // decode from string to array 
        $company_explode = json_decode($request->input('companyId') , true );
        $mutualFunds_explode = json_decode($request->input('mutualFundsId') , true );
        $company = Company::find($company_explode);
        $mutual_funds = MutualFunds::find($mutualFunds_explode);
        // insert data to pivot table 
        $mutual_funds->companies()->syncWithoutDetaching($company);
        return "Company added successfully to mutual fund";
    }
    
    public function mutualFundsShow($id)
    {
       
        $mutual_funds = MutualFunds::find($id)->toArray();
        $companies = DB::table('company_mutual_funds')->where('mutual_funds_id', $id)->get()->toArray();  
        $mutual_funds['companies'] = $companies; 
        $array = Arr::add([], 'price', 100);
        return $mutual_funds;
    }

}
