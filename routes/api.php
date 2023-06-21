<?php

use App\Http\Controllers\Api\Docotor\AuthController as DocotorAuthController;
use App\Http\Controllers\Api\Docotor\ForgetPasswordController as DocotorForgetPasswordController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\Patient\AuthController;
use App\Http\Controllers\Api\Patient\ForgetPasswordController;
use Illuminate\Http\Request;
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


Route::prefix('v1')->group(function () {
    Route::prefix('patient')->group(function () {
        Route::post('login',[AuthController::class,'login']);
        Route::post('register',[AuthController::class,'register']);
        Route::post('forget-password',[ForgetPasswordController::class,'forgetPassword']);
        Route::post('otp-verification',[ForgetPasswordController::class,'otpVerification']);
        Route::post('reset-password',[ForgetPasswordController::class,'resetPassword']);
    });

    Route::prefix('doctor')->group(function () {
        Route::post('login',[DocotorAuthController::class,'login']);
        Route::post('register',[DocotorAuthController::class,'register']);
        Route::post('forget-password',[DocotorForgetPasswordController::class,'forgetPassword']);
        Route::post('otp-verification',[DocotorForgetPasswordController::class,'otpVerification']);
        Route::post('reset-password',[DocotorForgetPasswordController::class,'resetPassword']);
    });

    Route::post('symptoms',[HomeController::class,'symptoms']);
    Route::post('specializations',[HomeController::class,'specializations']);
    Route::post('intents',[HomeController::class,'intents']);
});
