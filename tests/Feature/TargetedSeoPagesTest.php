<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class TargetedSeoPagesTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    protected function setUp(): void
    {
        parent::setUp();

        config(['app.url' => self::SITE_URL, 'marketing.site_url' => self::SITE_URL]);
        URL::forceRootUrl(self::SITE_URL);
        URL::forceScheme('https');
    }

    public function test_bill_of_lading_page_targets_software_intent_without_losing_its_specialized_scope(): void
    {
        $response = $this->get('/solutions/bill-of-lading-management')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('<title>نرم‌افزار مدیریت بارنامه حمل‌ونقل | سپند</title>', false)
            ->assertSee('<meta name="description" content="نرم‌افزار مدیریت بارنامه سپند برای کنترل اطلاعات HBL و MBL، ارتباط House/Master، نسخه‌های Draft و نهایی و اتصال بارنامه به Booking و پرونده حمل.">', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/solutions/bill-of-lading-management">', false)
            ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
            ->assertSee('<h1>مدیریت بارنامه‌های حمل‌ونقل با نرم‌افزار سپند</h1>', false)
            ->assertSee('شرکت‌های حمل‌ونقل و فورواردری زمانی با خطا و تأخیر روبه‌رو می‌شوند', false)
            ->assertSee('درخواست دموی مدیریت بارنامه در سپند', false)
            ->assertSee('href="'.self::SITE_URL.'/consultation"', false)
            ->assertSee('href="'.self::SITE_URL.'/transport-modes/sea"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/nvocc"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/document-management"', false)
            ->assertSee('صدور رسمی بارنامه جاده‌ای یا اتصال حاکمیتی در دامنه این صفحه ادعا نمی‌شود', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertValidJsonLd($content);

        foreach (['/transport-modes/sea', '/solutions/nvocc', '/modules/document-management', '/product'] as $sourcePath) {
            $this->get($sourcePath)
                ->assertOk()
                ->assertSee('href="'.self::SITE_URL.'/solutions/bill-of-lading-management"', false);
        }
    }

    private function assertValidJsonLd(string $content): void
    {
        preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $content, $structuredData);
        $this->assertNotEmpty($structuredData[1]);

        foreach ($structuredData[1] as $json) {
            $this->assertIsArray(json_decode($json, true, 512, JSON_THROW_ON_ERROR));
        }
    }
}
