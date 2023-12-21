<?php

use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/stripe-payment',[StripeController::class, 'stripe']);
Route::post('/stripe-payment',[StripeController::class, 'stripePayment'])->name('stripe.payment');
Route::get('success', [StripeController::class, 'success'])->name('success');
Route::get('failure', [StripeController::class, 'failure'])->name('failure');