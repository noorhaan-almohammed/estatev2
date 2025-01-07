<?php

use App\Http\Controllers\AboutusController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TransactionController;

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

Route::get('/', function () { return view('welcome');});

Auth::routes();

Route::post('/storeTransaction',[TransactionController::class,'store'])->name('storeTransaction');

Route::get('/transaction',[TransactionController::class , 'createTransaction'])->name('createTransaction');

Route::get('/viewUserTransaction/{id}',[TransactionController::class,'getViewTransaction'])->name('userViewTransaction');

Route::get('/admin',[TransactionController::class,'getusersTransaction'])->name('admin');

Route::put('/updateTransaction/{id}',[TransactionController::class,'updateTransaction'])->name('updateTransaction');

Route::post('/support', [SupportController::class, 'sendSupportMessage'])->name('sendSupportMessage');

Route::get('/about',[AboutusController::class,'index'])->name('about');

