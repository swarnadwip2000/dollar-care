<?php

use App\Http\Controllers\Api\Docotor\AuthController as DocotorAuthController;
use App\Http\Controllers\Api\Docotor\ForgetPasswordController as DocotorForgetPasswordController;
use App\Http\Controllers\Api\FCMController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\Patient\AuthController as AuthController;
use App\Http\Controllers\Api\Patient\ForgetPasswordController as ForgetPasswordController;
use App\Http\Controllers\Api\Doctor\DashboardController as DoctorDashboardController;
use App\Http\Controllers\Api\Doctor\ProfileController;
use App\Http\Controllers\Api\Patient\BookingController as BookingController;
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
    
    Route::post('login',[AuthController::class,'login']);
    Route::post('register',[AuthController::class,'register']);
    Route::post('forget-password',[ForgetPasswordController::class,'forgetPassword']);
    Route::post('otp-verification',[ForgetPasswordController::class,'otpVerification']);
    Route::post('reset-password',[ForgetPasswordController::class,'resetPassword']);
    

    // Route::prefix('doctor')->group(function () {
    //     Route::post('login',[DocotorAuthController::class,'login']);
    //     Route::post('register',[DocotorAuthController::class,'register']);
    //     Route::post('forget-password',[DocotorForgetPasswordController::class,'forgetPassword']);
    //     Route::post('otp-verification',[DocotorForgetPasswordController::class,'otpVerification']);
    //     Route::post('reset-password',[DocotorForgetPasswordController::class,'resetPassword']);
    // });

    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('symptoms',[HomeController::class,'symptoms']);
        Route::post('specializations',[HomeController::class,'specializations']);
        Route::post('all-doctors',[HomeController::class,'all_doctors']);
        Route::post('doctors',[HomeController::class,'doctorsList']);
        Route::post('search-doctors',[HomeController::class,'searchDoctorOrClinic']);
        Route::post('store-location', [HomeController::class,'storeLocation']);
        Route::post('appointment-history', [HomeController::class,'appointmentHistoryForUser']);

        Route::prefix('doctor')->group(function () { 
            Route::post('getProfile',[ProfileController::class,'getProfile']);
            Route::post('updateProfile',[ProfileController::class,'updateProfile']);
            Route::post('changePassword',[ProfileController::class,'changePassword']);
            Route::post('updateProfileImage',[ProfileController::class,'updateProfileImage']);
            
            Route::prefix('manage-clinic')->group(function () {
                Route::get('/', [DoctorDashboardController::class, 'manageClinic'])->name('index');
                Route::get('/add-address', [DoctorDashboardController::class, 'addAddress'])->name('create');
                Route::post('/add-address', [DoctorDashboardController::class, 'addAddressSubmit'])->name('create.submit');
                Route::get('/delete/{id}', [DoctorDashboardController::class, 'delete'])->name('delete');
                Route::get('/edit/{id}', [DoctorDashboardController::class, 'edit'])->name('edit');
                Route::post('/update', [DoctorDashboardController::class, 'update'])->name('update');
                Route::get('/slot-delete/{id}', [DoctorDashboardController::class, 'slotDelete'])->name('slot-delete');
            });

        });

        //slots routes
        Route::post('/booking-and-consultancy', [BookingController::class, 'bookingAndConsultancy']);
        Route::post('/appointment-store', [BookingController::class, 'storeAppointment']);
        Route::post('/visitDate', [BookingController::class, 'visitDate']);
        Route::post('/clinicVisitSlot', [BookingController::class, 'clinicVisitSlot']);
    });

});

// Route::post('/save-token', [FCMController::class,'index']);