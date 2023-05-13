<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReceiveController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;


Route::get('/',[DashboardController::class,'dashboard']);
Route::resource('asd', MemberController::class);

Route::get('/pay/get_month',[ReceiveController::class,'get_month'])->name('payment.get_month');
Route::get('/pay/get_price',[ReceiveController::class,'get_payable'])->name('payment.get_price');

Route::resource('payment', ReceiveController::class);
Route::get('/payer', [ReceiveController::class, 'show'])->name('payerget');




Route::post('/check-payment', [PaymentController::class, 'checkPayment'])->name('check-payment');


Route::resource('report', ReportController::class);
Route::get('/report/view', function () {
    return view();
});


