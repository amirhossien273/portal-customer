<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class DocumentSeoClusterTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    private const PAGES = [
        '/modules/document-management',
        '/solutions/document-management',
        '/solutions/document-readiness',
        '/solutions/bill-of-lading-management',
        '/modules/document-checklists',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        config(['app.url' => self::SITE_URL, 'marketing.site_url' => self::SITE_URL]);
        URL::forceRootUrl(self::SITE_URL);
        URL::forceScheme('https');
    }

    public function test_every_document_page_is_indexable_self_canonical_and_present_in_sitemap(): void
    {
        $sitemap = $this->get('/sitemap.xml')->assertOk()->getContent();

        foreach (self::PAGES as $path) {
            $content = $this->get($path)
                ->assertOk()
                ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
                ->assertSee('<link rel="canonical" href="'.self::SITE_URL.$path.'">', false)
                ->getContent();

            $this->assertStringContainsString('"@type":"WebPage"', $content, $path);
            $this->assertStringContainsString('"@type":"BreadcrumbList"', $content, $path);
            $this->assertSame(1, substr_count($sitemap, '<loc>'.self::SITE_URL.$path.'</loc>'), $path);
        }

        $this->assertArrayNotHasKey('/modules/document-checklists', config('site_seo_strategy.redirects'));
        $this->assertStringNotContainsString('Disallow: /modules', file_get_contents(public_path('robots.txt')) ?: '');
        $this->assertStringNotContainsString('Disallow: /solutions', file_get_contents(public_path('robots.txt')) ?: '');
    }

    public function test_keyword_ownership_titles_and_h1s_are_unique(): void
    {
        $expectedOwners = [
            '/modules/document-management' => 'نرم افزار مدیریت اسناد حمل و نقل',
            '/solutions/document-management' => 'چرخه تأیید اسناد حمل',
            '/solutions/document-readiness' => 'کنترل آماده بودن مدارک حمل',
            '/solutions/bill-of-lading-management' => 'نرم افزار مدیریت بارنامه HBL و MBL',
            '/modules/document-checklists' => 'چک لیست مدارک حمل',
        ];
        $documentPages = config('site_seo_strategy.clusters.documents.pages');
        $titles = [];
        $headings = [];

        foreach ($expectedOwners as $path => $query) {
            $this->assertSame($query, $documentPages[$path]['query']);
            $content = $this->get($path)->assertOk()->getContent();
            preg_match('/<title>(.*?)<\/title>/s', $content, $title);
            preg_match('/<h1[^>]*>(.*?)<\/h1>/s', $content, $heading);
            $titles[$path] = trim(strip_tags($title[1] ?? ''));
            $headings[$path] = trim(preg_replace('/\s+/u', ' ', strip_tags($heading[1] ?? '')));
            $this->assertSame(1, substr_count($content, '<h1'), $path);
        }

        $this->assertSame(count($titles), count(array_unique($titles)));
        $this->assertSame(count($headings), count(array_unique($headings)));
        $this->assertSame('نرم افزار مدیریت اسناد حمل‌ونقل و فورواردری | سپند', $titles['/modules/document-management']);
        $this->assertSame('چرخه تأیید اسناد حمل | Draft، Approval و Version Control | سپند', $titles['/solutions/document-management']);
        $this->assertSame('نرم افزار مدیریت اسناد حمل‌ونقل برای شرکت‌های فورواردری', $headings['/modules/document-management']);
        $this->assertSame('چرخه تأیید اسناد حمل را از Draft تا نسخه نهایی کنترل کنید', $headings['/solutions/document-management']);
    }

    public function test_document_pages_have_distinct_scope_and_contextual_internal_links(): void
    {
        $module = $this->get('/modules/document-management')
            ->assertOk()
            ->assertSee('Document Repository', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/document-management"', false)
            ->assertSee('چرخه تأیید و بازبینی اسناد', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/document-readiness"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/bill-of-lading-management"', false);

        $approval = $this->get('/solutions/document-management')
            ->assertOk()
            ->assertSee('HBL Draft v1', false)
            ->assertSee('HBL Draft v2', false)
            ->assertSee('Rejected / Needs Revision', false)
            ->assertSee('Archive / Audit Trail', false)
            ->assertSee('نرم افزار مدیریت اسناد حمل‌ونقل', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/document-management"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/document-readiness"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/operations-automation"', false)
            ->assertSee('به‌تنهایی اثبات‌کننده Version Approval نیست', false);

        $this->get('/solutions/document-readiness')
            ->assertOk()
            ->assertSee('آیا پرونده برای مرحله بعد آماده است؟', false)
            ->assertSee('چرخه بازبینی و تأیید Draft', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/document-management"', false);

        $this->get('/solutions/bill-of-lading-management')
            ->assertOk()
            ->assertSee('Draft، Revision و Approval', false)
            ->assertSee('گردش تأیید Draft بارنامه', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/document-management"', false);

        $this->get('/modules/document-checklists')
            ->assertOk()
            ->assertSee('Checklist Designer', false)
            ->assertSee('Dependency و Enforcement', false)
            ->assertSee('Warning یا Block', false);

        foreach ([$module, $approval] as $response) {
            foreach (['Search Intent', 'Cannibalization', 'مرزبندی نیت جست‌وجو', 'SEO Keyword', 'کلیدواژه هدف'] as $internalPhrase) {
                $response->assertDontSee($internalPhrase, false);
            }
        }
    }
}
