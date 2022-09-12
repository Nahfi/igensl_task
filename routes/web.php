<?php


use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\ConfigSettingsController;;
use App\Http\Controllers\Admin\GeneralSettingsController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminApplicationController;
use App\Http\Controllers\Admin\UserRoleController;

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

Route::get('/', function () {
    return view('welcome');
});

    //admin route start
    Route::prefix('admin')->name('admin.')->group(function(){


        // guest route start
        Route::middleware('guest:admin')->group(function(){

            //login controller
            Route::controller(LoginController::class)->group(function(){
                Route::get('/login','showLoginForm')->name('login');
                Route::post('/login/post','login')->name('login.post');
            });

            //forgetpassword controller
            Route::controller(ForgotPasswordController::class)->group(function(){
                Route::get('/reset-password','showLinkRequestForm')->name('resetPassword');
                Route::post('/reset-password/post','sendResetLinkEmail')->name('resetpassword.post');
            });

            //reset password controller
            Route::controller(ResetPasswordController::class)->group(function(){
                Route::get('/update-password/{token}','index')->name('updatePassword');
                Route::post('/update-password','update')->name('updatePassword.post');
            });

        });

        //guest route end




        //auth admin route start
        Route::middleware(['auth:admin','checkStatus'])->group(function(){

            //logout
            Route::controller(LoginController::class)->group(function(){
                Route::post('/logout','logout')->name('logout');
            });

            //home route
            Route::controller(HomeController::class)->group(function(){
                Route::get('/dashboard','index')->name('home');
            });

            //roles route
            Route::controller(RolesController::class)->prefix('roles')->name('roles.')->group(function(){
                Route::get('/index','index')->name('index');
                Route::get('/create','create')->name('create');
                Route::post('/store','store')->name('store');
                Route::get('/edit/{id}','edit')->name('edit');
                Route::post('/update/{id}','update')->name('update');
                Route::get('/destroy/{id}','destroy')->name('destroy');

            });

            //admin route
            Route::controller(AdminController::class)->name('admin.')->group(function(){
                Route::get('/index','index')->name('index');
                Route::get('/create','create')->name('create');
                Route::post('/store','store')->name('store');
                Route::get('/edit/{id}','edit')->name('edit');
                Route::post('/update/{id}','update')->name('update');
                Route::get('/destroy/{id}','destroy')->name('destroy');
            });

            //profile route
            Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function(){
                Route::get('/','index')->name('index');
                Route::post('/update','update')->name('update');
                Route::post('/update-password','updatePassword')->name('password.update');

            });


            //settings route
            Route::prefix('settings')->name('settings.')->group(function(){
                Route::controller(GeneralSettingsController::class)->group(function(){
                    Route::get('/general','generalSettings')->name('general');
                    Route::post('/general/post/{id}','generalSettingsUpdate')->name('general.post');
                });
                Route::controller(ConfigSettingsController::class)->group(function(){
                    Route::get('/config','configSettings')->name('config');
                    Route::get('/config-optimize-clear','optimizeClear')->name('config.optimize.clear');
                    Route::get('/config-optimize','optimize')->name('config.optimize');
                });
            });

            //user route
            Route::controller(UserController::class)->prefix('user')->name('user.')->group(function(){
                Route::get('/index','index')->name('index');
                Route::get('/create','create')->name('create');
                Route::post('/store','store')->name('store');
                Route::get('/show/{id}','show')->name('show');
                Route::get('/edit/{id}','edit')->name('edit');
                Route::post('/update/{id}','update')->name('update');
                Route::get('/destroy/{id}','destroy')->name('destroy');
                Route::get('/country/{countryName}','getCountryInformation')->name('country');
            });
            //application route
            Route::controller(AdminApplicationController::class)->prefix('application')->name('application.')->group(function(){
                Route::get('/index','index')->name('index');
                Route::get('/show/{id}','show')->name('show');
                Route::post('/update/{id}','update')->name('update');
                Route::get('/download/{name}','download')->name('download');
                Route::get('/destroy/{id}','destroy')->name('destroy');
                Route::get('/feed-back/{id}','feedback')->name('feedback');
                Route::post('/feed-back/{id}','feedbackStore')->name('feedback.store');
                Route::get('/feed-back/download/{name}','feedbackDownload')->name('feedback.download');
            });
            //user role route
            Route::controller(UserRoleController::class)->prefix('user-role')->name('user.role.')->group(function(){
                Route::get('/index','index')->name('index');
                Route::post('/update/{id}','update')->name('update');
            });


        });
        //auth admin route end

    });

    //admin route end

Route::fallback(function () {
    return redirect('/');
});
