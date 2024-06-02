<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;

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
    Route::get('/sellerRegistration/user/{name}', "sellerRegistrationPage")->name("sellerRegistrationPage")->middleware(Authenticate::class);

    Route::post('/sellerRegistration/user/{name}', "sellerRegistration")->name("sellerRegistration")->middleware(Authenticate::class);

    Route::get('/storeItem/shop/{name}', "storeItemPage")->name("storeItemPage")->middleware(Authenticate::class);

    Route::post('/storeItem/shop/{name}', "storeItem")->name("storeItem")->middleware(Authenticate::class);

    Route::get('/storeCategory', "storeCategoryPage")->name("storeCategoryPage")->middleware(Authenticate::class);

    Route::post('/storeCategory', "storeCategory")->name("storeCategory")->middleware(Authenticate::class);

});

Route::controller(TransactionController::class)->group(function()
{
    Route::get('/addToCart/item/{item_name}', "addToCart")->name("addToCart")->middleware(Authenticate::class);

    Route::get('/viewCart/user/{name}', "viewCart")->name("viewCart")->middleware(Authenticate::class);

    Route::get('/minusItem/item/{name}', "minusItem")->name("minusItem")->middleware(Authenticate::class);

    Route::get('/plusItem/item/{name}', "plusItem")->name("plusItem")->middleware(Authenticate::class);

    Route::get('/checkout/user/{name}', "checkout")->name("checkout")->middleware(Authenticate::class);

    Route::get('/viewTransaction/user/{name}', "viewTransaction")->name("viewTransaction")->middleware(Authenticate::class);

    Route::get('/viewTransactionDetail/user/{name}/transaction/{transaction_id}', "viewTransactionDetail")->name("viewTransactionDetail")->middleware(Authenticate::class);

    Route::get('/shopTransactionPage/shop/{name}', "shopTransactionPage")->name("shopTransactionPage")->middleware(Authenticate::class);

    Route::get('/shopTransactionAccept/shop/{name}/transaction/{transaction_id}', "shopTransactionAccept")->name("shopTransactionAccept")->middleware(Authenticate::class);

    Route::get('/shopTransactionReject/shop/{name}/transaction/{transaction_id}', "shopTransactionReject")->name("shopTransactionReject")->middleware(Authenticate::class);

    Route::get('/shopCatalog/shop/{name}', "shopCatalog")->name("shopCatalog")->middleware(Authenticate::class);
});
