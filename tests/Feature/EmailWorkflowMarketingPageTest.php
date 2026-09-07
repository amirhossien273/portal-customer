<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailWorkflowMarketingPageTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    protected function setUp(): void
    {
        parent::setUp();

        config(['app.url' => self::SITE_URL, 'marketing.site_url' => self::SITE_URL]);
        URL::forceRootUrl(self::SITE_URL);
        URL::forceScheme('https');
    }

    public function test_email_workflow_is_a_complete_indexable_module_page(): void
    {
        $module = config('site_modules.email-workflow-automation');
        $path = '/modules/email-workflow-automation';
        $content = $this->get($path)
            ->assertOk()
            ->assertSee('<title>'.$module['seo_title'].'</title>', false)
            ->assertSee('<meta name="description" content="'.e($module['meta_description']).'">', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.$path.'">', false)
            ->assertSee('ایمیل عملیاتی؛ متصل به پرونده حمل', false)
            ->assertSee('id="email-workflow-path"', false)
            ->assertSee('id="email-classification-scenarios"', false)
            ->assertSee('id="email-workflow-roadmap"', false)
            ->assertSee('aria-label="نمای مفهومی ماژول اتوماسیون ایمیل و گردش کار حمل"', false)
            ->assertSee('زیرساخت فعال', false)
            ->assertSee('P1 · در مسیر توسعه', false)
            ->assertSee('آیا سپند اکنون محتوای ایمیل را با AI طبقه‌بندی می‌کند؟', false)
            ->assertSee('Microsoft 365 و Outlook', false)
            ->assertSee('Gmail Workspace', false)
            ->assertSee('IMAP و SMTP', false)
            ->assertSee('sales@', false)
            ->assertSee('operation@', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/crm"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/transport-operations"', false)
            ->assertSee('data-ga-label="module_email-workflow-automation_hero_consultation"', false)
            ->assertSee('"@type":"SoftwareApplication"', false)
            ->assertSee('"@type":"FAQPage"', false)
            ->assertSee('"@type":"BreadcrumbList"', false)
            ->assertDontSee('<meta name="keywords"', false)
            ->getContent();

        $this->assertSame(1, substr_count($content, '<h1'));

        preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $content, $structuredData);
        $this->assertNotEmpty($structuredData[1]);
        foreach ($structuredData[1] as $json) {
            $this->assertIsArray(json_decode($json, true, 512, JSON_THROW_ON_ERROR));
        }
    }

    public function test_email_workflow_is_discoverable_from_primary_marketing_surfaces(): void
    {
        $url = self::SITE_URL.'/modules/email-workflow-automation';

        $this->get('/')
            ->assertOk()
            ->assertSee('href="'.$url.'"', false)
            ->assertSee('تبدیل ایمیل به Workflow حمل', false);

        $this->get('/modules')
            ->assertOk()
            ->assertSee('href="'.$url.'"', false)
            ->assertSee('اتوماسیون ایمیل و گردش کار حمل', false);

        $this->assertSame(1, substr_count(
            $this->get('/sitemap.xml')->assertOk()->getContent(),
            '<loc>'.$url.'</loc>'
        ));
    }

    public function test_email_module_metadata_stays_within_search_snippet_limits(): void
    {
        $module = config('site_modules.email-workflow-automation');

        $this->assertLessThanOrEqual(60, mb_strlen($module['seo_title']));
        $this->assertLessThanOrEqual(160, mb_strlen($module['meta_description']));
        $this->assertSame('اتوماسیون ایمیل شرکت حمل و نقل', $module['keywords'][0]);
    }
}
