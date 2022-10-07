<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MutualFundsController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\StockPriceChange;
use App\Http\Controllers\UserWalletController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/' , function() {
    return view('welcome');
});
Route::get('/token', function () {
    return csrf_token(); 
});

Route::get('dashboard' , [ CustomAuthController::class , 'dashboard' ] )->name('dashboard');
Route::get('login' , [CustomAuthController::class,'login'])->name("login");
Route::post('login' , [CustomAuthController::class , 'customLogin' ] )->name('login.customLogin');
Route::get('register' , [ CustomAuthController::class , 'register' ] );
Route::post('register' , [ CustomAuthController::class , 'customRegister' ] )->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
//Route::get('payment',[PaymentController::class , 'payment'])->name('payment');
//Route::post('payment_begin', [PaymentController::class , 'pay' ])->name('payment_begin');
Route::get('success', [PaymentController::class , 'success']);
Route::get('error', [PaymentController::class , 'error' ] );
Route::post('mutual_funds/create',[MutualFundsController::class , 'customCreateMutualFunds' ] )->name('mutual_funds.create');
Route::post('company/create',[CompanyController::class , 'customCreateCompany' ] )->name('createCompany.custom');
Route::get('company/create',[CompanyController::class , 'createCompany' ] )->name('createCompany.create');
Route::post('companyStore/mutualFunds',[MutualFundsController::class , 'companyStore' ] )->name('company.store');
Route::get('mutual_funds/show/{id}',[MutualFundsController::class , 'mutualFundsShow' ] )->name('mutualFunds.show');
//Route::post('openpay',[PaymentController::class , 'openpay' ] )->name('open.pay');
Route::get('payment',[PaymentController::class , 'paynow' ] )->name('open.payget');
Route::post('payment', [PaymentController::class , 'openpay' ])->name('payment_begin');
Route::get('price_change', [StockPriceChange::class , 'price_change' ])->name('price.change')->middleware('stock.price');
Route::post('store_wallet', [UserWalletController::class , 'index' ] )->name('store.wallet');
Route::get('company/show/{id}',[CompanyController::class , 'showCompany' ] )->name('company.show');
Route::get('test_redis',[CompanyController::class , 'testRedis' ] )->name('company.show');
Route::get('/profile/info' , [CustomAuthController::class , 'profileInfo' ])->name('profile.info');