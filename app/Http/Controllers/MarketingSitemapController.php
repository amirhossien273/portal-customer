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
            ['loc' => $baseUrl.'/compare', 'lastmod' => $lastModified],
            ['loc' => $baseUrl.'/compare/sepand-vs-royan', 'lastmod' => $lastModified],
            ['loc' => $baseUrl.'/compare/sepand-vs-saba', 'lastmod' => $lastModified],
            ['loc' => $baseUrl.'/compare/sepand-vs-other-transport-software', 'lastmod' => $lastModified],
            ['loc' => $baseUrl.'/compare/best-transport-software', 'lastmod' => $lastModified],
            ['loc' => $baseUrl.'/pricing', 'lastmod' => $lastModified],
            ['loc' => $baseUrl.'/about', 'lastmod' => $lastModified],
            ['loc' => $baseUrl.'/consultation', 'lastmod' => $lastModified],
        ];

        foreach (config('site_modules', []) as $slug => $module) {
            $screenshots = config('module_screenshots.'.$slug, []);
            $images = array_map(static function (array $screenshot) use ($baseUrl, $module): array {
                $encodedPath = implode('/', array_map('rawurlencode', explode('/', $screenshot['path'])));

                return [
                    'loc' => $baseUrl.'/assets/images/marketing/'.$encodedPath,
                    'title' => $screenshot['alt'] ?? $module['seo_title'],
                ];
            }, $screenshots);

            if ($images === []) {
                $images[] = [
                    'loc' => $baseUrl.'/assets/images/marketing/modules/'.rawurlencode($slug).'-hero.webp',
                    'title' => $module['seo_title'],
                ];
            }

            $urls[] = [
                'loc' => $baseUrl.'/modules/'.rawurlencode($slug),
                'lastmod' => $lastModified,
                'images' => $images,
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
