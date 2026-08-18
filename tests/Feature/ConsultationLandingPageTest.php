<?php

namespace Tests\Feature;

use App\Models\ConsultationRequest;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class ConsultationLandingPageTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    protected function setUp(): void
    {
        parent::setUp();

        config(['app.url' => self::SITE_URL]);
        URL::forceRootUrl(self::SITE_URL);
        URL::forceScheme('https');
    }

    public function test_consultation_page_is_transactional_indexable_and_complete(): void
    {
        $response = $this->get('/consultation')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('<title>درخواست دمو نرم‌افزار حمل‌ونقل و مشاوره خرید | سپند</title>', false)
            ->assertSee('<meta name="description" content="درخواست دموی نرم‌افزار مدیریت حمل‌ونقل سپند؛ فرایندهای فروش، Booking، عملیات، اسناد و مالی شرکت خود را بررسی و ماژول‌های مناسب را انتخاب کنید.">', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/consultation">', false)
            ->assertSee('<meta name="robots" content="index,follow,max-image-preview:large">', false)
            ->assertSee('درخواست دمو و مشاوره خرید', false)
            ->assertSee('نرم‌افزار حمل‌ونقل سپند', false)
            ->assertSee('در جلسه دمو سپند چه چیزی بررسی می‌شود؟', false)
            ->assertSee('دمو بر اساس فرایند واقعی شرکت شما', false)
            ->assertSee('بعد از ثبت درخواست چه اتفاقی می‌افتد؟', false)
            ->assertSee('سؤالات متداول درباره درخواست دمو سپند', false)
            ->assertSee('قبل از درخواست دمو بیشتر بررسی کنید', false)
            ->assertSee('ثبت درخواست دمو و نیازسنجی', false)
            ->assertSee('نمای نرم‌افزار سپند با اطلاعات نمونه', false)
            ->assertSee('alt="نمای نرم افزار مدیریت حمل و نقل سپند"', false)
            ->assertSee('width="835" height="335" loading="eager" fetchpriority="high"', false)
            ->assertSee('name="approximate_users"', false)
            ->assertSee('name="primary_need" required', false)
            ->assertSee('اطلاعات ثبت‌شده فقط برای بررسی و پیگیری درخواست دمو و مشاوره شما استفاده می‌شود.', false)
            ->assertSee('href="'.self::SITE_URL.'/pricing"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules"', false)
            ->assertSee('href="'.self::SITE_URL.'/compare/sepand-vs-other-transport-software"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/crm"', false)
            ->assertSee('href="'.self::SITE_URL.'/modules/transport-operations"', false)
            ->assertSee('"@type":"ContactPage"', false)
            ->assertSee('"@type":"BreadcrumbList"', false)
            ->assertSee('"@type":"FAQPage"', false)
            ->assertDontSee('آیا جلسه دمو رایگان است؟', false)
            ->assertDontSee('target="_blank"', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertSame(5, substr_count($content, '<details'));

        preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $content, $structuredData);
        $this->assertNotEmpty($structuredData[1]);
        foreach ($structuredData[1] as $json) {
            $this->assertIsArray(json_decode($json, true, 512, JSON_THROW_ON_ERROR));
        }
    }

    public function test_consultation_form_returns_persian_errors_for_invalid_qualification_data(): void
    {
        $this->from('/consultation')->post('/consultation', [
            'name' => 'کاربر آزمایشی',
            'company' => 'شرکت آزمایشی',
            'mobile' => 'invalid-number',
            'company_type' => 'شرکت فورواردری',
            'primary_need' => 'گزینه نامعتبر',
        ])->assertRedirect('/consultation')
            ->assertSessionHasErrors([
                'mobile' => 'شماره تماس را با رقم‌های معتبر وارد کنید.',
                'primary_need' => 'نیاز انتخاب‌شده معتبر نیست.',
            ]);
    }

    public function test_consultation_model_accepts_the_new_qualification_fields(): void
    {
        $request = new ConsultationRequest();

        $this->assertTrue($request->isFillable('approximate_users'));
        $this->assertTrue($request->isFillable('primary_need'));
    }
}
