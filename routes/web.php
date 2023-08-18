<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ForgetPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ClinicController;
use App\Http\Controllers\Admin\CmsController as AdminCmsController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\HelpAndSupportController;
use App\Http\Controllers\Admin\MembershipHistoryController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Controllers\Admin\SymptomsController;
use App\Http\Controllers\Doctor\BookingHistoryController;
use App\Http\Controllers\Doctor\ChatController as DoctorChatController;
use App\Http\Controllers\Doctor\DashboardController as DoctorDashboardController;
use App\Http\Controllers\Doctor\ManageClinicController;
use App\Http\Controllers\Doctor\NotificationController as DoctorNotificationController;
use App\Http\Controllers\Doctor\ProfileController as DoctorProfileController;
use App\Http\Controllers\Doctor\SettingsController;
use App\Http\Controllers\Frontend\AuthController as FrontendAuthController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\Frontend\BookingAndConsultancyController;
use App\Http\Controllers\Frontend\ChatController;
use App\Http\Controllers\Frontend\CmsController;
use App\Http\Controllers\Frontend\ForgetPasswordController as FrontendForgetPasswordController;
use App\Http\Controllers\Frontend\MembershipController;
use App\Http\Controllers\Frontend\NewsletterController as FrontendNewsletterController;
use App\Http\Controllers\Frontend\TeleHealthController;
use App\Http\Controllers\Patient\AppointmentController;
use App\Http\Controllers\Patient\DashboardController as PatientDashboardController;
use App\Http\Controllers\Patient\NotificationController;
use App\Http\Controllers\Patient\PaymentHistoryController;
use App\Http\Controllers\Patient\ProfileController as PatientProfileController;
use App\Http\Controllers\Patient\SettingController;
use Illuminate\Support\Facades\Artisan;

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

// Clear cache
Route::get('clear', function () {
    Artisan::call('optimize:clear');
    return "Optimize clear has been successfully";
});

Route::get('/admin', [AuthController::class, 'redirectAdminLogin']);
Route::get('/admin/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/login-check', [AuthController::class, 'loginCheck'])->name('admin.login.check');  //login check
Route::post('admin/forget-password', [ForgetPasswordController::class, 'forgetPassword'])->name('admin.forget.password');
Route::post('change-password', [ForgetPasswordController::class, 'changePassword'])->name('admin.change.password');
Route::get('forget-password/show', [ForgetPasswordController::class, 'forgetPasswordShow'])->name('admin.forget.password.show');
Route::get('reset-password/{id}/{token}', [ForgetPasswordController::class, 'resetPassword'])->name('admin.reset.password');
Route::post('change-password', [ForgetPasswordController::class, 'changePassword'])->name('admin.change.password');


Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::post('profile/update', [ProfileController::class, 'profileUpdate'])->name('admin.profile.update');
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/membership-bar-chart', [DashboardController::class, 'membershipBarChart'])->name('admin.membership.bar.chart');

    Route::prefix('password')->group(function () {
        Route::get('/', [ProfileController::class, 'password'])->name('admin.password'); // password change
        Route::post('/update', [ProfileController::class, 'passwordUpdate'])->name('admin.password.update'); // password update
    });

    Route::resources([
        'patients' => PatientController::class,
        'doctors' => DoctorController::class,
        'contact-us' => ContactUsController::class,
        'newsletters' => NewsletterController::class,
        'plans' => PlanController::class,
        'symptoms' => SymptomsController::class,
        'specializations' => SpecializationController::class,
        'notifications' => AdminNotificationController::class,
    ]);

    Route::get('notification-list-ajax', [AdminNotificationController::class, 'notificationListAjax'])->name('notifications.list-ajax');
    Route::get('notifications/delete/{id}', [AdminNotificationController::class, 'delete'])->name('notifications.delete');

    // symptom routes
    Route::prefix('symptoms')->group(function () {
        Route::get('/symptom-delete/{id}', [SymptomsController::class, 'delete'])->name('symptoms.delete');
    });
    Route::get('/symptom-status', [SymptomsController::class, 'changeStatus'])->name('symptoms.change-status');
    // Specialization routes
    Route::prefix('specializations')->group(function () {
        Route::get('/specialization-delete/{id}', [SpecializationController::class, 'delete'])->name('specializations.delete');
    });
    Route::get('/specialization-status', [SpecializationController::class, 'changeStatus'])->name('specializations.change-status');

    //  Customer Routes
    Route::prefix('patients')->group(function () {
        Route::get('/patient-delete/{id}', [PatientController::class, 'delete'])->name('patients.delete');
    });
    Route::prefix('plans')->group(function () {
        Route::get('/plans-delete/{id}', [PlanController::class, 'delete'])->name('plans.delete');
    });
    Route::get('/changePatientStatus', [PatientController::class, 'changePatientsStatus'])->name('patients.change-status');
    Route::get('/patient-ajax-list', [PatientController::class, 'ajaxList'])->name('patients.list-ajax');
    // Doctor Routes
    Route::get('/changeDoctorStatus', [DoctorController::class, 'changeDoctorsStatus'])->name('doctors.change-status');
    Route::prefix('doctors')->group(function () {
        Route::get('/doctor-delete/{id}', [DoctorController::class, 'delete'])->name('doctors.delete');
    });
    Route::get('/doctor-ajax-list', [DoctorController::class, 'ajaxList'])->name('doctors.list-ajax');

    Route::prefix('blogs')->name('blogs.')->group(function () {
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', [BlogController::class, 'categoryIndex'])->name('index');
            Route::get('/create', [BlogController::class, 'categoryCreate'])->name('create');
            Route::post('/store', [BlogController::class, 'categoryStore'])->name('store');
            Route::get('/edit/{id}', [BlogController::class, 'categoryEdit'])->name('edit');
            Route::post('/update', [BlogController::class, 'categoryUpdate'])->name('update');
            Route::get('/delete/{id}', [BlogController::class, 'categoryDelete'])->name('delete');
        });
        Route::get('/', [BlogController::class, 'index'])->name('index');
        Route::get('/create', [BlogController::class, 'create'])->name('create');
        Route::post('/store', [BlogController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('edit');
        Route::post('/update', [BlogController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [BlogController::class, 'delete'])->name('delete');
        Route::get('/changeBlogStatus', [BlogController::class, 'changeBlogStatus'])->name('change-status');
        // blog ajax list
        Route::get('/blog-ajax-list', [BlogController::class, 'ajaxList'])->name('list-ajax');
    });

    Route::prefix('cms')->name('cms.')->group(function () {
        Route::prefix('qna')->name('qna.')->group(function () {
            Route::get('/', [AdminCmsController::class, 'qnaIndex'])->name('index');
            Route::post('/store', [AdminCmsController::class, 'qnaStore'])->name('store');
            Route::post('/edit/{id}', [AdminCmsController::class, 'qnaEdit'])->name('edit');
            Route::post('/update', [AdminCmsController::class, 'qnaUpdate'])->name('update');
            Route::get('/delete/{id}', [AdminCmsController::class, 'qnaDelete'])->name('delete');
            Route::get('/qnaChangeStatus', [AdminCmsController::class, 'qnaChangeStatus'])->name('change-status');
        });

        Route::prefix('contact-us')->name('contact-us.')->group(function () {
            Route::get('/', [AdminCmsController::class, 'contactUsIndex'])->name('index');
            Route::post('/update', [AdminCmsController::class, 'contactUsUpdate'])->name('update');
        });

        Route::prefix('about-us')->name('about-us.')->group(function () {
            Route::get('/', [AdminCmsController::class, 'aboutUsIndex'])->name('index');
            Route::post('/update', [AdminCmsController::class, 'aboutUsUpdate'])->name('update');
        });

        Route::prefix('privacy-policy')->name('privacy-policy.')->group(function () {
            Route::get('/', [AdminCmsController::class, 'privacyPolicyIndex'])->name('index');
            Route::post('/update', [AdminCmsController::class, 'privacyPolicyUpdate'])->name('update');
        });
    });

    Route::prefix('appointments')->name('appointments.')->group(function () {
        Route::get('/', [AdminAppointmentController::class, 'index'])->name('index');
        Route::get('/booking-history-ajax', [AdminAppointmentController::class, 'bookingHistoryAjax'])->name('booking-history-ajax');
    });

    Route::prefix('clinics')->name('clinics.')->group(function () {
        Route::get('/', [ClinicController::class, 'index'])->name('index');
        Route::get('/list-ajax', [ClinicController::class, 'listAjax'])->name('list-ajax');
    });

    Route::prefix('membership-history')->name('membership-history.')->group(function () {
        Route::get('/', [MembershipHistoryController::class, 'index'])->name('index');
        Route::get('/list-ajax', [MembershipHistoryController::class, 'listAjax'])->name('list-ajax');
        Route::get('/delete', [MembershipHistoryController::class, 'delete'])->name('delete');
    });

    Route::get('/help-and-support', [HelpAndSupportController::class, 'helpAndSupport'])->name('help-and-support.index');
    // help and support list ajax
    Route::get('/help-and-support-list-ajax', [HelpAndSupportController::class, 'helpAndSupportListAjax'])->name('help-and-support.list-ajax');
});


/**------------------------------------------------------------- Frontend  ----------------------------------------------------------------------------------------------*/

Route::get('/', [CmsController::class, 'index'])->name('home');
Route::get('/about-us', [CmsController::class, 'aboutUs'])->name('about-us');
Route::get('/services', [CmsController::class, 'services'])->name('services');
Route::get('/contact-us', [CmsController::class, 'contactUs'])->name('contact-us');
Route::post('/contact-us', [CmsController::class, 'contactUsSubmit'])->name('contact-us.submit');
// qna
Route::get('/qna', [CmsController::class, 'qna'])->name('qna');
// membership plans
Route::get('/membership-plans', [CmsController::class, 'membershipPlans'])->name('membership-plans');

// Mobile health coverage
Route::get('/mobile-health-coverage', [CmsController::class, 'mobileHealthCoverage'])->name('mobile-health-coverage');

//store location
Route::post('/store-location', [CmsController::class, 'storeLocation'])->name('store.location');

Route::get('/qna-blogs/{slug?}', [FrontendBlogController::class, 'blogs'])->name('blogs');
Route::get('/blog-details/{category_slug}/{blog_slug}', [FrontendBlogController::class, 'blogDetails'])->name('blogs.details');
// search result
Route::post('/search-result', [FrontendBlogController::class, 'searchResult'])->name('blogs.search');

Route::get('/login', [FrontendAuthController::class, 'login'])->name('login');
Route::get('/register', [FrontendAuthController::class, 'register'])->name('register');
Route::post('/register-store', [FrontendAuthController::class, 'registerStore'])->name('register.store');
Route::post('/user-login-check', [FrontendAuthController::class, 'loginCheck'])->name('login.check');
Route::get('/check-validation', [FrontendAuthController::class, 'checkValidation'])->name('check.validation');

// forget password
Route::get('/forget-password', [FrontendForgetPasswordController::class, 'forgetPassword'])->name('forget.password');
Route::post('/forget-password', [FrontendForgetPasswordController::class, 'forgetPasswordSubmit'])->name('forget.password.submit');
Route::get('/otp-verification/{id}', [FrontendForgetPasswordController::class, 'otpVerification'])->name('otp.verification');
Route::post('/otp-verification', [FrontendForgetPasswordController::class, 'otpVerificationSubmit'])->name('otp.verification.submit');
Route::get('/reset-password/{id}', [FrontendForgetPasswordController::class, 'resetPassword'])->name('reset.password');
Route::post('/reset-password', [FrontendForgetPasswordController::class, 'resetPasswordSubmit'])->name('reset.password.submit');

// newsletter
Route::post('/newsletter', [FrontendNewsletterController::class, 'newsletter'])->name('newsletter');

Route::get('/telehealth', [TeleHealthController::class, 'telehealth'])->name('telehealth');
Route::group(['middleware' => 'access.telehealth'], function () {
    // telehealth
    Route::get('/view-all-specializations', [TeleHealthController::class, 'viewAllSpecializations'])->name('all-specializations');
    Route::get('/search-specilzation', [TeleHealthController::class, 'searchSpecialization'])->name('search.specilzation');
    Route::get('/search-doctor', [TeleHealthController::class, 'doctorSearch'])->name('search-doctor');
    Route::get('/doctor-filter',[TeleHealthController::class, 'doctorFilter'])->name('doctor-filter');
    // doctors
    Route::get('/doctors/{type}/{slug}', [TeleHealthController::class, 'doctors'])->name('doctors');
    Route::get('/booking-and-consultancy/{id}', [BookingAndConsultancyController::class, 'bookingAndConsultancy'])->name('booking-and-consultancy');
    Route::post('/appointment-store', [BookingAndConsultancyController::class, 'storeAppointment'])->name('appointment-store');
    
    Route::get('/visitSlotAjax', [BookingAndConsultancyController::class, 'visitSlotAjax'])->name('clinic.visit.slot-ajax');
    Route::get('/clinicVisitSlotAjax', [BookingAndConsultancyController::class, 'clinicVisitSlotAjax'])->name('clinic.ajax-clinic-visit-slot-time');
    Route::get('/thank-you', [BookingAndConsultancyController::class, 'thankYou'])->name('thank-you');


    
    
});


// member ship 
Route::post('/membership-model', [MembershipController::class, 'membershipModel'])->name('membership.model');
Route::post('/membership-payment', [MembershipController::class, 'membershipPayment'])->name('membership.payment');
// clinic visit slot ajax
    // chat
Route::post('/user-chat', [ChatController::class, 'userChat'])->name('user-chat');
Route::get('/doctors-chat', [BookingAndConsultancyController::class, 'doctorChat'])->name('doctor.chat');

/**------------------------------------------------------------- Patient  ----------------------------------------------------------------------------------------------*/
Route::prefix('patient')->name('patient.')->middleware('access.patient')->group(function () {
    Route::get('/dashboard', [PatientDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [PatientProfileController::class, 'profile'])->name('profile');
    Route::post('/profile-update', [PatientProfileController::class, 'profileUpdate'])->name('profile.update');
    // notifications
    Route::get('/notifications', [NotificationController::class, 'notifications'])->name('notifications');
    // logout
    Route::get('/logout', [FrontendAuthController::class, 'patientLogout'])->name('logout');

    // Payment History
    Route::get('/payment-history', [PaymentHistoryController::class, 'paymentHistory'])->name('payment-history');
    // Setting
    Route::get('/setting', [SettingController::class, 'setting'])->name('settings');
    Route::post('/help-and-support', [SettingController::class, 'helpAndSupport'])->name('help-and-support');
    // my appointment
    Route::get('/my-appointment', [AppointmentController::class, 'myAppointment'])->name('appointment');
    Route::get('/my-appointment/cancel/{id}', [AppointmentController::class, 'myAppointmentCancel'])->name('my-appointment.cancel');
});

/**------------------------------------------------------------- Doctor  ----------------------------------------------------------------------------------------------*/

Route::prefix('doctor')->name('doctor.')->middleware('access.doctor')->group(function () {
    Route::get('/dashboard', [DoctorDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [DoctorProfileController::class, 'profile'])->name('profile');
    Route::post('/profile-update', [DoctorProfileController::class, 'profileUpdate'])->name('profile.update');
    // change password
    Route::get('/change-password', [DoctorProfileController::class, 'changePassword'])->name('change.password');
    Route::post('/change-password', [DoctorProfileController::class, 'changePasswordSubmit'])->name('change.password.submit');
    // notifications
    Route::get('/notifications', [DoctorNotificationController::class, 'notifications'])->name('notifications');
    Route::get('/settings', [SettingsController::class, 'settings'])->name('settings');
    Route::post('/help-and-support', [SettingsController::class, 'helpAndSupport'])->name('help-and-support');
    Route::prefix('manage-clinic')->name('manage-clinic.')->group(function () {
        Route::get('/', [ManageClinicController::class, 'manageClinic'])->name('index');
        Route::get('/add-address', [ManageClinicController::class, 'addAddress'])->name('create');
        Route::post('/add-address', [ManageClinicController::class, 'addAddressSubmit'])->name('create.submit');
        Route::get('/delete/{id}', [ManageClinicController::class, 'delete'])->name('delete');
        Route::get('/edit/{id}', [ManageClinicController::class, 'edit'])->name('edit');
        Route::post('/update', [ManageClinicController::class, 'update'])->name('update');
        Route::get('/slot-delete/{id}', [ManageClinicController::class, 'slotDelete'])->name('slot-delete');
    });
    Route::get('/booking-history', [BookingHistoryController::class, 'bookingHistory'])->name('booking-history');
    Route::get('/booking-history-ajax', [BookingHistoryController::class, 'bookingHistoryAjax'])->name('booking-history-ajax');
    // logout
    Route::get('/logout', [FrontendAuthController::class, 'doctorLogout'])->name('logout');
    // chat
    Route::get('/chat', [DoctorChatController::class, 'index'])->name('chat.index');
    Route::post('/load-chats', [DoctorChatController::class, 'loadChat'])->name('chat.load');
});


Route::get('/thanks', function () {
    return view('frontend.thanks');
});