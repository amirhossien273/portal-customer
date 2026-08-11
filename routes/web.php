<?php

use App\Http\Controllers\MarketingConsultationController;
use App\Http\Controllers\MarketingModuleController;
use App\Http\Controllers\MarketingSitemapController;
use App\Http\Controllers\MarketingTransportModeController;
use App\Http\Controllers\CustomerPortalAuthController;
use App\Http\Controllers\CustomerPortalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('marketing.trailing-slash')->group(function (): void {
    Route::view('/', 'welcome')->name('home');
    Route::get('/sitemap.xml', MarketingSitemapController::class)->name('sitemap');
    Route::view('/faq', 'marketing.faq')->name('faq');
    Route::view('/modules', 'marketing.modules')->name('modules');
    Route::view('/compare/transport-software-vs-excel', 'marketing.compare-transport-software-excel')
        ->name('compare.transport-software-excel');
    Route::get('/modules/{module}', [MarketingModuleController::class, 'show'])
        ->whereIn('module', array_keys(config('site_modules')))
        ->name('site.modules.show');
    Route::get('/transport-modes/{mode}', [MarketingTransportModeController::class, 'show'])
        ->whereIn('mode', array_keys(config('site_transport_modes')))
        ->name('site.transport-modes.show');
    Route::view('/pricing', 'marketing.pricing')->name('pricing');
    Route::view('/about', 'marketing.about')->name('about');
    Route::get('/consultation', [MarketingConsultationController::class, 'create'])->name('consultation.create');
});

Route::post('/consultation', [MarketingConsultationController::class, 'store'])->name('consultation.store');
Route::redirect('/organization-portal', '/login?purpose=organization')->name('organization.portal');

Route::get('/login', [CustomerPortalAuthController::class, 'showLogin'])->name('login');
Route::post('/login/otp', [CustomerPortalAuthController::class, 'requestOtp'])
    ->middleware('throttle:10,1')
    ->name('login.otp');
Route::get('/login/verify', [CustomerPortalAuthController::class, 'showVerify'])->name('login.verify');
Route::post('/login/verify', [CustomerPortalAuthController::class, 'verify'])
    ->middleware('throttle:15,1')
    ->name('login.verify.submit');
Route::post('/login/resend', [CustomerPortalAuthController::class, 'resend'])
    ->middleware('throttle:5,1')
    ->name('login.resend');

Route::middleware('portal.auth')->prefix('portal')->name('portal.')->group(function (): void {
    Route::get('/', [CustomerPortalController::class, 'dashboard'])->name('dashboard');
    Route::get('/inquiries', [CustomerPortalController::class, 'inquiries'])->name('inquiries.index');
    Route::get('/inquiries/{inquiry}', [CustomerPortalController::class, 'inquiry'])->name('inquiries.show');
    Route::get('/shipments', [CustomerPortalController::class, 'shipments'])->name('shipments.index');
    Route::get('/shipments/{shipment}', [CustomerPortalController::class, 'shipment'])->name('shipments.show');
    Route::get('/financials', [CustomerPortalController::class, 'financials'])->name('financials');
    Route::get('/profile', [CustomerPortalController::class, 'profile'])->name('profile');
    Route::post('/logout', [CustomerPortalAuthController::class, 'logout'])->name('logout');
});

Route::get('/tracking', fn (Request $request) => $request->session()->has('customer_portal')
    ? redirect()->route('portal.shipments.index')
    : redirect()->route('login', ['purpose' => 'tracking']))->name('tracking');
