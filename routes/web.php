<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReceiveController;
use Illuminate\Support\Facades\Route;

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
// Route::get('/', function () {
    //     return view('layouts.dashboard');
    // });


Route::get('/',[DashboardController::class,'dashboard']);
Route::resource('asd', MemberController::class);

Route::get('/pay/get_month',[ReceiveController::class,'get_month'])->name('payment.get_month');
Route::get('/pay/get_price',[ReceiveController::class,'get_price'])->name('payment.get_price');
Route::resource('payment', ReceiveController::class);

