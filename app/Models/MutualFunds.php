<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use App\Models\CompanyMutualFunds;

class MutualFunds extends Model
{
    use HasFactory;
    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
    public function company_mutual_funds()
    {
        return $this->hasMany(CompanyMutualFunds::class);
    }
}
