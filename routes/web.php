<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/blog', function () {
    return view('home');
});

Route::get('/contact', function () {
    return view('home');
});

Route::controller(AuthController::class)->group(function(){
    Route::get('/login', "loginPage")->name("loginPage");

    Route::post('/login', "login")->name("login");

    Route::get('/logout', "logout")->name("logout");

    Route::get('/registration', "registrationPage")->name("registrationPage");

    Route::post('/registration', "registration")->name("registration");

    Route::get('/forgot-password', "forgotPasswordPage")->name('password.request');

    Route::post('/forgot-password', "forgotPassword")->name('password.email');

    Route::get('/reset-password/{token}', "resetPasswordPage")->name('password.reset');

    Route::post('/reset-password', "resetPassword")->name('password.update');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware(Authenticate::class);

Route::get('/getSession', function () {
    return session()->all();
});
