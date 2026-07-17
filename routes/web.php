<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::view('/modules', 'marketing.modules')->name('modules');
Route::view('/pricing', 'marketing.pricing')->name('pricing');
Route::view('/about', 'marketing.about')->name('about');
Route::view('/login', 'auth.customer-login')->name('login');
