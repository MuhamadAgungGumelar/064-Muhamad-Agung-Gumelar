<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/blog', function () {
    return view('home');
});

Route::get('/contact', function () {
    return view('home');
});
