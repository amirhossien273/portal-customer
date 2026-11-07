<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class MarketingPlatformSolutionController extends Controller
{
    public function index(): View
    {
        $hub = config('site_platform_solutions.hub', []);
        $problemGroups = $hub['problem_groups'] ?? [];
        $solutionItems = collect($problemGroups)
            ->flatMap(fn (array $group): array => $group['solutions'] ?? [])
            ->values();

        return view('marketing.platform-solutions.index', [
            'problemGroups' => $problemGroups,
            'solutionItems' => $solutionItems,
            'title' => 'راهکارهای نرم‌افزاری حمل‌ونقل و فورواردری | سپند',
            'description' => 'راهکارهای سپند برای پیگیری فروش، مدیریت نرخ، عملیات، اسناد و کنترل مالی شرکت‌های حمل‌ونقل و فورواردری را بر اساس مسئله شرکت خود بررسی کنید.',
            'canonical' => route('solutions.index'),
            'image' => asset('assets/images/marketing/product-showcase/desktop-dashboard.webp'),
            'imageAlt' => 'راهکارهای یکپارچه نرم‌افزار حمل‌ونقل سپند',
            'imageWidth' => 1600,
            'imageHeight' => 799,
        ]);
    }

    public function show(string $solution): View
    {
        $page = config('site_platform_solutions.pages.'.$solution);

        abort_unless(is_array($page), 404);

        $view = $solution === 'rate-management'
            ? 'marketing.rate-management'
            : 'marketing.platform-solutions.show';

        return view($view, [
            'slug' => $solution,
            'page' => $page,
            'allSolutions' => config('site_platform_solutions.pages', []),
            'title' => $page['title'],
            'description' => $page['description'],
            'canonical' => route('solutions.platform.show', ['solution' => $solution]),
            'image' => asset('assets/images/marketing/'.$page['image']),
            'imageAlt' => $page['image_alt'],
            'imageWidth' => 1600,
            'imageHeight' => 900,
        ]);
    }
}
