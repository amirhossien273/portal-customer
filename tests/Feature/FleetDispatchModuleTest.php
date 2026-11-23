<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class FleetDispatchModuleTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    protected function setUp(): void
    {
        parent::setUp();

        config(['app.url' => self::SITE_URL, 'marketing.site_url' => self::SITE_URL]);
        URL::forceRootUrl(self::SITE_URL);
        URL::forceScheme('https');
    }

    public function test_fleet_dispatch_page_owns_final_assignment_and_mission_execution_intent(): void
    {
        $content = $this->get('/modules/fleet-dispatch')
            ->assertOk()
            ->assertSee('<title>نرم‌افزار دیسپچ ناوگان و تخصیص کامیون به بار | سپند</title>', false)
            ->assertSee('<meta name="description" content="در سپند، کامیون و راننده را به سفارش حمل تخصیص دهید، نتیجه ثبت را در پرونده ببینید و وضعیت اجرای مأموریت را دنبال کنید.">', false)
            ->assertSee('<meta property="og:title" content="نرم‌افزار دیسپچ ناوگان و تخصیص کامیون به بار | سپند">', false)
            ->assertSee('<meta name="twitter:title" content="نرم‌افزار دیسپچ ناوگان و تخصیص کامیون به بار | سپند">', false)
            ->assertSee('نرم‌افزار دیسپچ ناوگان برای ثبت تخصیص کامیون و راننده', false)
            ->assertSee('دیسپچ ناوگان در حمل زمینی چیست؟', false)
            ->assertSee('ثبت تخصیص کامیون برای یک سفارش خروج بار از بندرعباس', false)
            ->assertSee('Trip Assignment', false)
            ->assertSee('تخصیص‌های جاری اعزام‌ها', false)
            ->assertSee('Start، Complete یا Cancel', false)
            ->assertSee('سرویس ثبت با خطای اعتبارسنجی مانع ایجاد Assignment جدید می‌شود', false)
            ->assertSee('live/fleet-compliance-control.png', false)
            ->assertSee('modules/screenshots/operations-calendar-list.webp', false)
            ->assertSee('data-module-screenshot-slider', false)
            ->assertSee('touchstart', false)
            ->assertSee('تخصیص یک کامیون به سفارش حمل را در دمو ببینید', false)
            ->assertSee('href="'.self::SITE_URL.'/consultation"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/fleet-management"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/fleet-dispatch-planning"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/truck-movement-planning"', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/modules/fleet-dispatch">', false)
            ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
            ->assertSee('"@type":"WebPage"', false)
            ->assertSee('"@type":"FAQPage"', false)
            ->getContent();

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertSame(1, substr_count(
            $this->get('/sitemap.xml')->assertOk()->getContent(),
            '<loc>'.self::SITE_URL.'/modules/fleet-dispatch</loc>'
        ));
    }
}
