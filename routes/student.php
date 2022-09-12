<?php
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CustomerProfileController;
use App\Http\Controllers\User\ApplicationController;

//user route start
Auth::routes(['verify' => true]);
Route::name('user.')->group(function(){

     //application route start
    Route::prefix('/application')->name('application.')->controller(ApplicationController::class)->group(function(){
        Route::post('/store','store')->name('store');
        Route::get('/country/{countryName}','getCountryInformation')->name('country');
        Route::post('/update/{id}','update')->name('update');
    });

    //user auth route start
    Route::middleware(['auth:web','verified','checkStatus'])->prefix('user')->group(function(){
        //user home route
        Route::controller(DashboardController::class)->group(function(){
            Route::get('/dashboard','index')->name('home');
        });

        //auth application route start
        Route::prefix('/application')->name('application.')->controller(ApplicationController::class)->group(function(){
            Route::get('/show/{id}','show')->name('show');
            Route::get('/edit/{id}','edit')->name('edit');
            Route::get('/download/{name}','download')->name('download');
            Route::get('/feed-back/download/{name}','feedbackDownload')->name('feedback.download');
        });
        //user profile route
        Route::controller(CustomerProfileController::class)->prefix('profile')->name('profile.')->group(function(){
            Route::get('/','index')->name('index');
            Route::post('/update','update')->name('update');
            Route::post('/update-password','updatePassword')->name('password.update');
        });

    });

    //user auth route end
});

//user route end