<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('screens.login');
});
Route::get('/register', function () {
    return view('screens.register');
});
