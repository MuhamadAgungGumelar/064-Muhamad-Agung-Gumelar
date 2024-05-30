<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\DashboardController;
use App\Models\User;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
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

Route::controller(DashboardController::class)->group(function(){
    Route::get('/dashboard', 'dashboardIndex')->name('dashboardIndex')->middleware(Authenticate::class);

    Route::get('/dashboard/category/{category_name}', 'showByCategory')->name('showByCategory')->middleware(Authenticate::class);

    Route::get('/dashboard/shop/{shop_name}', 'showByShop')->name('showByShop')->middleware(Authenticate::class);

    Route::get('/dashboard/shop/{shop_name}/category/{category_name}', 'showByShopItem')->name('showByShopItem')->middleware(Authenticate::class);
});


Route::get('/getSession', function () {
    return session()->all();
});

Route::controller(SellerController::class)->group(function()
{
    Route::get('/sellerRegistration/{name}', "sellerRegistrationPage")->name("sellerRegistrationPage");

    Route::post('/sellerRegistration/{name}', "sellerRegistration")->name("sellerRegistration");

    Route::get('/storeItem/{name}', "storeItemPage")->name("storeItemPage");

    Route::post('/storeItem/{name}', "storeItem")->name("storeItem");

    Route::get('/storeCategory', "storeCategoryPage")->name("storeCategoryPage");

    Route::post('/storeCategory', "storeCategory")->name("storeCategory");

});
