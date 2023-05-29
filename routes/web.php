<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ForgetPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Frontend\AuthController as FrontendAuthController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\Frontend\CmsController;
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
Route::post('forget-password', [ForgetPasswordController::class, 'forgetPassword'])->name('admin.forget.password');
Route::post('change-password', [ForgetPasswordController::class, 'changePassword'])->name('admin.change.password');
Route::get('forget-password/show', [ForgetPasswordController::class, 'forgetPasswordShow'])->name('admin.forget.password.show');
Route::get('reset-password/{id}/{token}', [ForgetPasswordController::class, 'resetPassword'])->name('admin.reset.password');
Route::post('change-password', [ForgetPasswordController::class, 'changePassword'])->name('admin.change.password');

Route::group(['middleware' => ['admin'], 'prefix'=>'admin'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::post('profile/update', [ProfileController::class, 'profileUpdate'])->name('admin.profile.update');
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
    
    Route::prefix('password')->group(function () {
        Route::get('/', [ProfileController::class, 'password'])->name('admin.password'); // password change
        Route::post('/update', [ProfileController::class, 'passwordUpdate'])->name('admin.password.update'); // password update
    });    

    Route::resources([
        'patients' => PatientController::class,
        'doctors' => DoctorController::class,
        'contact-us' => ContactUsController::class,
    ]);
    //  Customer Routes
    Route::prefix('patients')->group(function () {
        Route::get('/patient-delete/{id}', [PatientController::class, 'delete'])->name('patients.delete');
    });
    Route::get('/changePatientStatus', [PatientController::class, 'changePatientsStatus'])->name('patients.change-status');

    // Doctor Routes
    Route::get('/changeDoctorStatus', [DoctorController::class, 'changeDoctorsStatus'])->name('doctors.change-status');
    Route::prefix('doctors')->group(function () {
        Route::get('/doctor-delete/{id}', [DoctorController::class, 'delete'])->name('doctors.delete');
    });

    Route::prefix('blogs')->name('blogs.')->group(function(){
        Route::prefix('categories')->name('categories.')->group(function(){
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
    });
});


/**------------------------------------------------------------- Frontend  ----------------------------------------------------------------------------------------------*/

Route::get('/', [CmsController::class, 'index'])->name('home');
Route::get('/about-us', [CmsController::class, 'aboutUs'])->name('about-us');
Route::get('/services', [CmsController::class, 'services'])->name('services');
Route::get('/contact-us', [CmsController::class, 'contactUs'])->name('contact-us');
Route::post('/contact-us', [CmsController::class, 'contactUsSubmit'])->name('contact-us.submit');
Route::get('/blogs/{slug?}', [FrontendBlogController::class, 'blogs'])->name('blogs');
Route::get('/blog-details/{category_slug}/{blog_slug}', [FrontendBlogController::class, 'blogDetails'])->name('blogs.details');
// search result
Route::post('/search-result', [FrontendBlogController::class, 'searchResult'])->name('blogs.search');

Route::get('/login', [FrontendAuthController::class, 'login'])->name('login');
Route::get('/register', [FrontendAuthController::class, 'register'])->name('register');
Route::post('/register-store', [FrontendAuthController::class, 'registerStore'])->name('register.store');
Route::post('/user-login-check', [FrontendAuthController::class, 'loginCheck'])->name('login.check');
Route::get('/logout', [FrontendAuthController::class, 'logout'])->name('logout');
