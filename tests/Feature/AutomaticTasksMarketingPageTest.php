<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class AutomaticTasksMarketingPageTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'app.url' => self::SITE_URL,
            'marketing.site_url' => self::SITE_URL,
        ]);
        URL::forceRootUrl(self::SITE_URL);
        URL::forceScheme('https');
    }

    public function test_automatic_tasks_module_page_is_indexable_accurate_and_structured(): void
    {
        $module = config('site_modules.automatic-tasks');
        $response = $this->get('/modules/automatic-tasks')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('<title>'.e($module['seo_title']).'</title>', false)
            ->assertSee('<meta name="description" content="'.e($module['meta_description']).'">', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/modules/automatic-tasks">', false)
            ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
            ->assertSee('<span class="module-hero-title-main">تسک خودکار CRM</span>', false)
            ->assertSee('<span class="module-hero-title-accent">برای پیگیری لید و فروش</span>', false)
            ->assertSee('ساخت خودکار تسک پس از ثبت لید', false)
            ->assertSee('پیگیری خودکار استعلام جدید', false)
            ->assertSee('پیگیری پس از ارسال پیشنهاد نرخ', false)
            ->assertSee('فعال و غیرفعال‌سازی برای هر سازمان', false)
            ->assertSee('در نسخه فعلی این صفحه برای ساخت قانون کاملاً سفارشی طراحی نشده است.', false)
            ->assertSee('آیا کاربر باید فرمان زمان‌بندی اجرا کند؟', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/crm"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/pricing-sales"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/workflow-tasks"', false)
            ->assertSee('assets/images/marketing/modules/screenshots/automatic-task-rules.webp', false)
            ->assertSee('<meta property="og:image:width" content="1600">', false)
            ->assertSee('<meta property="og:image:height" content="851">', false)
            ->assertSee('"@type":"SoftwareApplication"', false)
            ->assertSee('"@type":"FAQPage"', false)
            ->assertSee('"@type":"BreadcrumbList"', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertStringNotContainsString('noindex', strtolower($content));

        preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $content, $structuredData);
        $this->assertNotEmpty($structuredData[1]);

        foreach ($structuredData[1] as $json) {
            $this->assertIsArray(json_decode($json, true, 512, JSON_THROW_ON_ERROR));
        }
    }

    public function test_automatic_tasks_page_is_discoverable_and_has_a_real_social_image(): void
    {
        foreach (['/', '/modules'] as $path) {
            $this->get($path)
                ->assertOk()
                ->assertSee('href="'.self::SITE_URL.'/modules/automatic-tasks"', false)
                ->assertSee('تسک خودکار', false);
        }

        $sitemap = $this->get('/sitemap.xml')->assertOk()->getContent();
        $this->assertSame(
            1,
            substr_count($sitemap, '<loc>'.self::SITE_URL.'/modules/automatic-tasks</loc>')
        );
        $this->assertStringContainsString(
            '<image:loc>'.self::SITE_URL.'/assets/images/marketing/modules/screenshots/automatic-task-rules.webp</image:loc>',
            $sitemap
        );

        $imagePath = public_path('assets/images/marketing/modules/screenshots/automatic-task-rules.webp');
        $this->assertFileExists($imagePath);
        $image = getimagesize($imagePath);
        $this->assertSame(1600, $image[0]);
        $this->assertSame(851, $image[1]);
        $this->assertSame('image/webp', $image['mime']);
    }

    public function test_automatic_tasks_keyword_target_does_not_compete_with_workflow_page(): void
    {
        $automaticKeywords = config('site_modules.automatic-tasks.keywords');
        $workflowKeywords = config('site_modules.workflow-tasks.keywords');

        $this->assertSame([
            'تسک خودکار CRM',
            'اتوماسیون پیگیری فروش',
            'ساخت خودکار تسک',
            'پیگیری خودکار لید',
            'یادآوری خودکار پیگیری مشتری',
        ], $automaticKeywords);
        $this->assertSame([], array_values(array_intersect($automaticKeywords, $workflowKeywords)));
        $this->assertLessThanOrEqual(60, mb_strlen(config('site_modules.automatic-tasks.seo_title')));
        $this->assertLessThanOrEqual(160, mb_strlen(config('site_modules.automatic-tasks.meta_description')));
    }
}
