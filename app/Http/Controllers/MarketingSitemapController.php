<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class MarketingSitemapController extends Controller
{
    public function __invoke(): Response
    {
        $baseUrl = config('marketing.site_url');
        $lastModified = config('marketing.content_last_modified');
        $urls = [
            [
                'loc' => $baseUrl.'/',
                'lastmod' => $lastModified,
                'images' => [['loc' => $baseUrl.'/assets/images/marketing/sepand-cargo-details.webp', 'title' => 'نرم‌افزار CRM و مدیریت عملیات حمل‌ونقل سپند']],
            ],
            ['loc' => $baseUrl.'/faq', 'lastmod' => $lastModified],
            ['loc' => $baseUrl.'/modules', 'lastmod' => $lastModified],
            ['loc' => $baseUrl.'/compare/transport-software-vs-excel', 'lastmod' => $lastModified],
            ['loc' => $baseUrl.'/pricing', 'lastmod' => $lastModified],
            ['loc' => $baseUrl.'/about', 'lastmod' => $lastModified],
            ['loc' => $baseUrl.'/consultation', 'lastmod' => $lastModified],
        ];

        foreach (config('site_modules', []) as $slug => $module) {
            $urls[] = [
                'loc' => $baseUrl.'/modules/'.rawurlencode($slug),
                'lastmod' => $lastModified,
                'images' => [[
                    'loc' => $baseUrl.'/assets/images/marketing/modules/'.rawurlencode($slug).'-hero.webp',
                    'title' => $module['seo_title'],
                ]],
            ];
        }

        foreach (config('site_transport_modes', []) as $slug => $mode) {
            $urls[] = [
                'loc' => $baseUrl.'/transport-modes/'.rawurlencode($slug),
                'lastmod' => $lastModified,
                'images' => [[
                    'loc' => $baseUrl.'/assets/images/marketing/transport-modes/'.rawurlencode($slug).'-hero.webp',
                    'title' => $mode['seo_title'],
                ]],
            ];
        }

        return response()
            ->view('marketing.sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml; charset=UTF-8')
            ->header('Cache-Control', 'public, max-age=3600');
    }
}
