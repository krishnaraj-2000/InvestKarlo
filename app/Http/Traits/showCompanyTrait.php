<?php

namespace App\Http\Traits;
use App\Models\Company ;
trait showCompanyTrait
{
    public function showCompanyTrait($id)
    {
        $company_details = Company::where('id' ,$id )->get();
        return $company_details ;
    }
}