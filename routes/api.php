<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Tenongan\DetailTransaksiController;
use App\Http\Controllers\Tenongan\KasController;
use App\Http\Controllers\Tenongan\LogKasController;
use App\Http\Controllers\Tenongan\LogSaldoController;
use App\Http\Controllers\Tenongan\PedagangController;
use App\Http\Controllers\Tenongan\PenjualanController;
use App\Http\Controllers\Tenongan\ProdukController;
use App\Http\Controllers\Tenongan\ProdusenController;
use App\Http\Controllers\Tenongan\SaldoController;
use App\Http\Controllers\Tenongan\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('user', [UserController::class, 'current']);

    Route::patch('settings/profile', [ProfileController::class, 'update']);
    Route::patch('settings/password', [PasswordController::class, 'update']);
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);

    Route::post('oauth/{driver}', [OAuthController::class, 'redirect']);
    Route::get('oauth/{driver}/callback', [OAuthController::class, 'handleCallback'])->name('oauth.callback');

    Route::get('produk',[ProdukController::class,'index'])->name('produk');
    Route::get('produk/{produk}',[ProdukController::class,'show'])->name('produk.show');
    Route::post('produk',[ProdukController::class,'store'])->name('produk.store');
    Route::delete('produk/{produk}',[ProdukController::class,'destroy'])->name('produk.destroy');
    Route::patch('produk/{produk}',[ProdukController::class,'update'])->name('produk.update');

    Route::get('produsen',[ProdusenController::class,'index'])->name('produsen');
    Route::get('produsen/{produsen}',[ProdusenController::class,'show'])->name('produsen.show');
    Route::post('produsen',[ProdusenController::class,'store'])->name('produsen.store');
    Route::delete('produsen/{produsen}',[ProdusenController::class,'destroy'])->name('produsen.destroy');
    Route::patch('produsen/{produsen}',[ProdusenController::class,'update'])->name('produsen.update');

    Route::get('pedagang',[PedagangController::class,'index'])->name('pedagang');
    Route::get('pedagang/{pedagang}',[PedagangController::class,'show'])->name('pedagang.show');
    Route::post('pedagang',[PedagangController::class,'store'])->name('pedagang.store');
    Route::delete('pedagang/{pedagang}',[PedagangController::class,'destroy'])->name('pedagang.destroy');
    Route::patch('pedagang/{pedagang}',[PedagangController::class,'update'])->name('pedagang.update');

    Route::get('kas',[KasController::class,'index'])->name('kas');
    Route::get('kas/{kas}',[KasController::class,'show'])->name('kas.show');
    Route::post('kas/{kas}/dec',[KasController::class,'decrease'])->name('kas.decrease');
    Route::post('kas/{kas}/in',[KasController::class,'increase'])->name('kas.increase');

    Route::get('saldo',[SaldoController::class,'index'])->name('saldo');
    Route::get('saldo/{saldo}',[SaldoController::class,'show'])->name('saldo.show');
    Route::post('saldo/{saldo}/dec',[SaldoController::class,'decrease'])->name('saldo.decrease');
    Route::post('saldo/{saldo}/in',[SaldoController::class,'increase'])->name('saldo.increase');

});
