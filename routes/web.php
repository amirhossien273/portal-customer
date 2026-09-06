<?php

use App\Http\Controllers\MarketingConsultationController;
use App\Http\Controllers\MarketingComparisonController;
use App\Http\Controllers\MarketingCaseStudyController;
use App\Http\Controllers\MarketingContentPageController;
use App\Http\Controllers\MarketingModuleController;
use App\Http\Controllers\MarketingPlatformSolutionController;
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
    Route::view('/product', 'marketing.product-overview')->name('product');
    Route::view('/why-sepand', 'marketing.why-sepand')->name('why-sepand');
    Route::view('/modules', 'marketing.modules')->name('modules');
    Route::get('/solutions', [MarketingPlatformSolutionController::class, 'index'])
        ->name('solutions.index');
    Route::get('/compare', [MarketingComparisonController::class, 'index'])->name('compare.index');
    Route::get('/compare/sepand-vs-royan', [MarketingComparisonController::class, 'competitor'])
        ->defaults('competitor', 'royan')
        ->name('compare.sepand-vs-royan');
    Route::get('/compare/sepand-vs-saba', [MarketingComparisonController::class, 'competitor'])
        ->defaults('competitor', 'saba')
        ->name('compare.sepand-vs-saba');
    Route::get('/compare/best-transport-software', [MarketingComparisonController::class, 'best'])
        ->name('compare.best-transport-software');
    Route::get('/compare/best-freight-forwarding-software', [MarketingContentPageController::class, 'show'])
        ->defaults('contentGroup', 'guides')
        ->defaults('contentSlug', 'best-freight-forwarding-software')
        ->name('compare.best-freight-forwarding-software');
    Route::get('/compare/best-crm-for-transport-companies', [MarketingContentPageController::class, 'show'])
        ->defaults('contentGroup', 'guides')
        ->defaults('contentSlug', 'best-crm-for-transport-companies')
        ->name('compare.best-crm-for-transport-companies');
    Route::get('/compare/best-transport-accounting-software', [MarketingContentPageController::class, 'show'])
        ->defaults('contentGroup', 'guides')
        ->defaults('contentSlug', 'best-transport-accounting-software')
        ->name('compare.best-transport-accounting-software');
    Route::permanentRedirect(
        '/compare/transport-software-vs-excel',
        '/compare/sepand-vs-other-transport-software'
    );
    Route::view('/compare/sepand-vs-other-transport-software', 'marketing.compare-sepand-other-transport-software')
        ->name('compare.sepand-other-transport-software');
    foreach (config('site_seo_strategy.redirects', []) as $legacyPath => $primaryPath) {
        Route::permanentRedirect($legacyPath, $primaryPath);
    }
    Route::get('/modules/{module}', [MarketingModuleController::class, 'show'])
        ->whereIn('module', array_keys(config('site_modules')))
        ->name('site.modules.show');
    Route::get('/transport-modes/{mode}', [MarketingTransportModeController::class, 'show'])
        ->whereIn('mode', array_keys(config('site_transport_modes')))
        ->name('site.transport-modes.show');
    Route::get('/solutions/nvocc', [MarketingContentPageController::class, 'show'])
        ->defaults('contentGroup', 'solutions')
        ->defaults('contentSlug', 'nvocc')
        ->name('solutions.nvocc');
    Route::get('/solutions/container-management', [MarketingContentPageController::class, 'show'])
        ->defaults('contentGroup', 'solutions')
        ->defaults('contentSlug', 'container-management')
        ->name('solutions.container-management');
    Route::get('/solutions/on-premise', [MarketingContentPageController::class, 'show'])
        ->defaults('contentGroup', 'solutions')
        ->defaults('contentSlug', 'on-premise')
        ->name('solutions.on-premise');
    Route::get('/solutions/bill-of-lading-management', [MarketingContentPageController::class, 'show'])
        ->defaults('contentGroup', 'solutions')
        ->defaults('contentSlug', 'bill-of-lading-management')
        ->name('solutions.bill-of-lading-management');
    Route::get('/solutions/freight-sales-automation', [MarketingContentPageController::class, 'show'])
        ->defaults('contentGroup', 'solutions')
        ->defaults('contentSlug', 'freight-sales-automation')
        ->name('solutions.freight-sales-automation');
    Route::get('/solutions/shipment-visibility', [MarketingContentPageController::class, 'show'])
        ->defaults('contentGroup', 'solutions')
        ->defaults('contentSlug', 'shipment-visibility')
        ->name('solutions.shipment-visibility');
    Route::get('/solutions/operation-exception-management', [MarketingContentPageController::class, 'show'])
        ->defaults('contentGroup', 'solutions')
        ->defaults('contentSlug', 'operation-exception-management')
        ->name('solutions.operation-exception-management');
    Route::get('/solutions/transport-governance', [MarketingContentPageController::class, 'show'])
        ->defaults('contentGroup', 'solutions')
        ->defaults('contentSlug', 'transport-governance')
        ->name('solutions.transport-governance');
    Route::get('/solutions/document-readiness', [MarketingContentPageController::class, 'show'])
        ->defaults('contentGroup', 'solutions')
        ->defaults('contentSlug', 'document-readiness')
        ->name('solutions.document-readiness');
    Route::get('/solutions/fleet-dispatch-planning', [MarketingContentPageController::class, 'show'])
        ->defaults('contentGroup', 'solutions')
        ->defaults('contentSlug', 'fleet-dispatch-planning')
        ->name('solutions.fleet-dispatch-planning');
    Route::get('/solutions/{solution}', [MarketingPlatformSolutionController::class, 'show'])
        ->whereIn('solution', array_keys(config('site_platform_solutions.pages', [])))
        ->name('solutions.platform.show');
    Route::view('/pricing', 'marketing.pricing')->name('pricing');
    Route::view('/about', 'marketing.about')->name('about');
    Route::get('/customers/case-studies/{caseStudy}', [MarketingCaseStudyController::class, 'show'])
        ->whereIn('caseStudy', array_keys(config('site_case_studies', [])))
        ->name('case-studies.show');
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
    Route::get('/accounts', [CustomerPortalAuthController::class, 'showAccounts'])->name('accounts.index');
    Route::post('/accounts', [CustomerPortalAuthController::class, 'selectAccount'])->name('accounts.select');
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
