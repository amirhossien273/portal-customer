<?php

use App\Http\Controllers\MarketingConsultationController;
use App\Http\Controllers\MarketingModuleController;
use App\Http\Controllers\MarketingSitemapController;
use App\Http\Controllers\MarketingTransportModeController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::get('/sitemap.xml', MarketingSitemapController::class)->name('sitemap');
Route::view('/faq', 'marketing.faq')->name('faq');
Route::view('/modules', 'marketing.modules')->name('modules');
Route::get('/modules/{module}', [MarketingModuleController::class, 'show'])
    ->whereIn('module', array_keys(config('site_modules')))
    ->name('site.modules.show');
Route::get('/transport-modes/{mode}', [MarketingTransportModeController::class, 'show'])
    ->whereIn('mode', array_keys(config('site_transport_modes')))
    ->name('site.transport-modes.show');
Route::view('/pricing', 'marketing.pricing')->name('pricing');
Route::view('/about', 'marketing.about')->name('about');
Route::get('/consultation', [MarketingConsultationController::class, 'create'])->name('consultation.create');
Route::post('/consultation', [MarketingConsultationController::class, 'store'])->name('consultation.store');
Route::redirect('/tracking', '/login?purpose=tracking')->name('tracking');
Route::redirect('/organization-portal', '/login?purpose=organization')->name('organization.portal');
Route::view('/login', 'auth.customer-login')->name('login');
