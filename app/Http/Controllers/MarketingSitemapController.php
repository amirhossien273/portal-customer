<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class MarketingSitemapController extends Controller
{
    public function __invoke(): Response
    {
        $baseUrl = config('marketing.site_url');
        $urls = [
            ['loc' => $baseUrl.'/', 'changefreq' => 'weekly', 'priority' => '1.0'],
            ['loc' => $baseUrl.'/modules', 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => $baseUrl.'/pricing', 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => $baseUrl.'/about', 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => $baseUrl.'/consultation', 'changefreq' => 'monthly', 'priority' => '0.6'],
        ];

        foreach (array_keys(config('site_modules', [])) as $slug) {
            $urls[] = [
                'loc' => $baseUrl.'/modules/'.rawurlencode($slug),
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ];
        }

        return response()
            ->view('marketing.sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
