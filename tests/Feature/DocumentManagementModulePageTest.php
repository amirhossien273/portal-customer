<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class DocumentManagementModulePageTest extends TestCase
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

    public function test_document_module_matches_verified_attachment_and_dms_boundaries(): void
    {
        $canonical = self::SITE_URL.'/modules/document-management';
        $consultationUrl = self::SITE_URL.'/consultation?source_page='.rawurlencode($canonical);
        $response = $this->get('/modules/document-management')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('<title>نرم‌افزار مدیریت اسناد حمل‌ونقل | سپند</title>', false)
            ->assertSee('<meta name="description" content="بارنامه، فاکتور و مدارک حمل را در پرونده مرتبط در سپند نگه دارید. مسیر ثبت و دسترسی به اسناد را با یک پرونده نمونه در دمو بررسی کنید.">', false)
            ->assertSee('<meta property="og:title" content="نرم‌افزار مدیریت اسناد حمل‌ونقل | سپند">', false)
            ->assertSee('<meta name="twitter:description" content="بارنامه، فاکتور و مدارک حمل را در پرونده مرتبط در سپند نگه دارید. مسیر ثبت و دسترسی به اسناد را با یک پرونده نمونه در دمو بررسی کنید.">', false)
            ->assertSee('<link rel="canonical" href="'.$canonical.'">', false)
            ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
            ->assertSee('id="document-file-scenario"', false)
            ->assertSee('بارنامه و مدارک هر حمل را در همان پرونده پیدا کنید', false)
            ->assertSee('تب «فایل‌های پیوست»', false)
            ->assertSee('«اسناد و چک‌لیست»', false)
            ->assertSee('پنجره ساده پیوست به‌تنهایی تاریخچه نسخه را نشان نمی‌دهد', false)
            ->assertSee('alt="پنجره واقعی افزودن فایل پیوست با عنوان اختیاری در پرونده استعلام سپند"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/document-management"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/document-readiness"', false)
            ->assertSee('href="'.self::SITE_URL.'/solutions/bill-of-lading-management"', false)
            ->assertSee('id="document-purchase-checklist"', false)
            ->assertSee('پیش از خرید نرم‌افزار مدیریت اسناد حمل‌ونقل چه چیزهایی را در دمو بررسی کنید؟', false)
            ->assertSee('href="'.$consultationUrl.'" data-ga-event="cta_click" data-ga-label="module_document-management_scenario_consultation">مدیریت اسناد یک پرونده حمل را در دمو ببینید</a>', false)
            ->assertSee('href="'.$consultationUrl.'" data-ga-event="cta_click" data-ga-label="module_document-management_purchase_consultation">مدیریت اسناد یک پرونده حمل را در دمو ببینید</a>', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertGreaterThanOrEqual(4, substr_count($content, 'href="'.$consultationUrl.'"'));
        $this->assertLessThan(strpos($content, 'id="module-problems-title"'), strpos($content, 'id="document-file-scenario"'));
        $this->assertLessThan(strpos($content, 'id="document-purchase-checklist"'), strpos($content, 'id="module-faq-title"'));
        $this->assertWebPageSchemaMatchesMetadata($content, $canonical);
        $this->assertFaqSchemaMatchesVisibleAnswer(
            $content,
            'نسخه اصلاحی سند چگونه مشخص می‌شود؟',
            'نسخه‌بندی در رکورد سند عملیاتی و DMS انجام می‌شود؛ شماره نسخه، نسخه قبلی، وضعیت گردش و Audit Trail قابل ثبت‌اند. پنجره ساده پیوست به‌تنهایی تاریخچه نسخه را نشان نمی‌دهد.'
        );
    }

    public function test_document_demo_link_preserves_source_page_in_consultation_form(): void
    {
        $sourcePage = self::SITE_URL.'/modules/document-management';

        $this->get('/consultation?source_page='.rawurlencode($sourcePage))
            ->assertOk()
            ->assertSee('name="source_page" value="'.$sourcePage.'"', false);
    }

    private function assertWebPageSchemaMatchesMetadata(string $content, string $canonical): void
    {
        $webPage = $this->schemaNodes($content)
            ->first(fn (array $node): bool => ($node['@type'] ?? null) === 'WebPage');

        $this->assertNotNull($webPage);
        $this->assertSame($canonical, $webPage['url']);
        $this->assertSame('نرم‌افزار مدیریت اسناد حمل‌ونقل | سپند', $webPage['name']);
        $this->assertSame(
            'بارنامه، فاکتور و مدارک حمل را در پرونده مرتبط در سپند نگه دارید. مسیر ثبت و دسترسی به اسناد را با یک پرونده نمونه در دمو بررسی کنید.',
            $webPage['description']
        );
    }

    private function assertFaqSchemaMatchesVisibleAnswer(string $content, string $question, string $answer): void
    {
        $faq = $this->schemaNodes($content)
            ->first(fn (array $node): bool => ($node['@type'] ?? null) === 'FAQPage');

        $this->assertNotNull($faq);
        $matchedQuestion = collect($faq['mainEntity'] ?? [])->firstWhere('name', $question);
        $this->assertNotNull($matchedQuestion);
        $this->assertSame($answer, $matchedQuestion['acceptedAnswer']['text']);
    }

    private function schemaNodes(string $content)
    {
        preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $content, $matches);

        return collect($matches[1] ?? [])->flatMap(function (string $json): array {
            $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

            return $data['@graph'] ?? [$data];
        });
    }
}
