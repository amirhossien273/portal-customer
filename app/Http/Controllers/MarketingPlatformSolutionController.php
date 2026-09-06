<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class MarketingPlatformSolutionController extends Controller
{
    public function index(): View
    {
        $solutions = config('site_platform_solutions.pages', []);
        $hub = config('site_platform_solutions.hub', []);
        $specializedSolutions = collect(config('site_content_pages.solutions', []))->keyBy('route');
        $specializedGroups = collect($hub['specialized_groups'] ?? [])->map(function (array $group) use ($specializedSolutions): array {
            $group['solutions'] = collect($group['routes'] ?? [])
                ->map(fn (string $route) => $specializedSolutions->get($route))
                ->filter()
                ->values()
                ->all();

            return $group;
        })->all();

        return view('marketing.platform-solutions.index', [
            'solutions' => $solutions,
            'hub' => $hub,
            'specializedGroups' => $specializedGroups,
            'specializedSolutionsCount' => $specializedSolutions->count(),
            'title' => 'راهکارهای نرم‌افزار حمل‌ونقل و لجستیک سپند',
            'description' => 'هاب راهکارهای نرم‌افزار حمل‌ونقل سپند؛ انتخاب راهکار بر اساس مسئله برای عملیات، مالی، نرخ، ناوگان، کانتینر، اسناد، برنامه حرکت و حمل چندوجهی.',
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

        return view('marketing.platform-solutions.show', [
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
