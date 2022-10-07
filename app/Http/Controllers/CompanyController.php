<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Company ;
use Illuminate\Support\Facades\Redis; 
use App\Http\Traits\showCompanyTrait;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    use showCompanyTrait ;
    public function createCompany()
    {
        return view('company');
    }

    public function customCreateCompany(Request $request )
    {
        //Redis::flushDb();
        //exit;
        $companyId = self::getCompanyId();
       //dump($company_id);
        $data = $request->all();
        self::newCompany($companyId , $data) ;
        $companyIds = Redis::zRange('companies', 0, -1 );
        //dump($companyIds);  
        $companys = [];  
    
        foreach ($companyIds as $companyId => $score) 
        {  
            $companys[$score]= Redis::hGetAll("company:$companyId");

        } 
        //Redis::flushDb();
        
        dump($companys);
        // $result = Company::create([
        //     'name' => $data['name']
        // ]);
        $company = new Company();
        $company->name = $data['name'];
        $company->price = $data['price'];
        $company->save();
        return "Company created ";
    }

    static function newCompany($companyId, $data)   
	 {   
        // zAdd :  Add one or more members to a sorted set or update its score if it already exists
          //dump($company_id);
          Redis::zAdd('companies' , time() , $companyId);
		  Redis::hMset("company:$companyId", $data);  
          //dump(Redis::hGetAll("company:$company_id"));
	 } 

     static function getCompanyId()  
     {  
         if(!Redis::exists('company_count')) 
          Redis::set('company_count',0);  
          return Redis::incr('company_count');  
        //dd(Redis::get('company_count'));
    } 

    public function showCompany($id)
    {
       
        Log::info('showing company details ');
        $companyDetails = $this->showCompanyTrait($id) ;
        return $companyDetails;
    }

     public function testRedis()
    {
        // Redis::set('ping','pong');
        // $ping = Redis::get('ping');
        dd(Auth::user());
        
    }
}

