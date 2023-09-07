<?php

use App\Http\Controllers\Api\Docotor\AuthController as DocotorAuthController;
use App\Http\Controllers\Api\Docotor\ForgetPasswordController as DocotorForgetPasswordController;
use App\Http\Controllers\Api\Doctor\BookingHistoryController;
use App\Http\Controllers\Api\FCMController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\Patient\AuthController as AuthController;
use App\Http\Controllers\Api\Patient\ForgetPasswordController as ForgetPasswordController;
use App\Http\Controllers\Api\Doctor\DashboardController as DoctorDashboardController;
use App\Http\Controllers\Api\Doctor\ManageClinicController;
use App\Http\Controllers\Api\Doctor\NotificationController;
use App\Http\Controllers\Api\Doctor\ProfileController;
use App\Http\Controllers\Api\Doctor\SettingsController;
use App\Http\Controllers\Api\Patient\AppointmentController;
use App\Http\Controllers\Api\Patient\BookingController as BookingController;
use App\Http\Controllers\Api\Patient\ChatController;
use App\Http\Controllers\Api\Patient\MembershipController;
use App\Http\Controllers\Api\Patient\NotificationController as PatientNotificationController;
use App\Http\Controllers\Api\Patient\PaymentController;
use App\Http\Controllers\Api\Patient\ProfileController as PatientProfileController;
use App\Http\Controllers\Patient\PaymentHistoryController;
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

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('forget-password', [ForgetPasswordController::class, 'forgetPassword']);
    Route::post('otp-verification', [ForgetPasswordController::class, 'otpVerification']);
    Route::post('reset-password', [ForgetPasswordController::class, 'resetPassword']);


    // Route::prefix('doctor')->group(function () {
    //     Route::post('login',[DocotorAuthController::class,'login']);
    //     Route::post('register',[DocotorAuthController::class,'register']);
    //     Route::post('forget-password',[DocotorForgetPasswordController::class,'forgetPassword']);
    //     Route::post('otp-verification',[DocotorForgetPasswordController::class,'otpVerification']);
    //     Route::post('reset-password',[DocotorForgetPasswordController::class,'resetPassword']);
    // });

    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('symptoms', [HomeController::class, 'symptoms']);
        Route::post('specializations', [HomeController::class, 'specializations']);
        Route::post('all-doctors-by-location', [HomeController::class, 'allDoctorsByLocation']);
        Route::post('doctors', [HomeController::class, 'doctorsList']);
        Route::post('search-doctors', [HomeController::class, 'searchDoctorOrClinic']);
        Route::post('store-location', [HomeController::class, 'storeLocation']);
        Route::post('appointment-history', [HomeController::class, 'appointmentHistoryForUser']);

        Route::prefix('doctor')->group(function () {
            Route::post('getProfile', [ProfileController::class, 'getProfile']);
            Route::post('updateProfile', [ProfileController::class, 'updateProfile']);
            Route::post('changePassword', [ProfileController::class, 'changePassword']);
            Route::post('updateProfileImage', [ProfileController::class, 'updateProfileImage']);

            Route::prefix('manage-clinic')->group(function () {
                Route::post('/list', [ManageClinicController::class, 'index']);
                Route::post('/create', [ManageClinicController::class, 'create']);
                Route::post('/store', [ManageClinicController::class, 'store']);
                Route::post('/edit', [ManageClinicController::class, 'edit']);
                Route::post('/update', [ManageClinicController::class, 'update']);
                Route::post('/delete', [ManageClinicController::class, 'delete']);
                Route::post('/presentSheduleDate', [ManageClinicController::class, 'presentSheduleDate']);
                Route::post('/deletePresentSheduleDate', [ManageClinicController::class, 'deletePresentSheduleDate']);
            });

            // booking history
            Route::prefix('booking-history')->group(function () {
                Route::post('/list-with-filter', [BookingHistoryController::class, 'listWithFilter']);
            });

            // notifications routes
            Route::post('/notifications', [NotificationController::class, 'notifications']);
            Route::post('/help-and-support', [SettingsController::class, 'helpAndSupport']);
            Route::post('/privacy-policy', [SettingsController::class, 'privacyPolicy']);
            Route::post('/about-us', [SettingsController::class, 'aboutUs']);
        });

        Route::prefix('patient')->group(function () {
            Route::post('getProfile', [PatientProfileController::class, 'getProfile']);
            Route::post('updateProfile', [PatientProfileController::class, 'updateProfile']);
            Route::post('changePassword', [PatientProfileController::class, 'changePassword']);
            Route::post('updateProfileImage', [PatientProfileController::class, 'updateProfileImage']);
            Route::post('/notifications', [PatientNotificationController::class, 'notifications']);

            // appoimtment 
            Route::post('/upcoming-appointment', [AppointmentController::class, 'upcomingAppointment']);
            Route::post('/appointment-history', [AppointmentController::class, 'appointmentHistory']);
            // payment history
            Route::post('/payment-history', [PaymentController::class, 'paymentHistory']);

            Route::prefix('membership')->group(function () {
                Route::post('/list', [MembershipController::class, 'membershipList']);
                Route::post('/detailById', [MembershipController::class, 'detailById']);
                Route::post('/payment', [MembershipController::class, 'membershipPayment']);
            });

            // friend request
            Route::post('/chat-request', [ChatController::class, 'chatRequest']);
            Route::post('/chat-request-send', [ChatController::class, 'chatRequestSend']);
        });

        //slots routes
        Route::post('/doctor-details', [BookingController::class, 'doctorDetails']);
        Route::post('/appointment-store', [BookingController::class, 'storeAppointment']);
        Route::post('/visitDate', [BookingController::class, 'visitDate']);
        Route::post('/clinicVisitSlot', [BookingController::class, 'clinicVisitSlot']);
    });
});

// Route::post('/save-token', [FCMController::class,'index']);