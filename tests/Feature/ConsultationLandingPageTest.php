<?php

namespace Tests\Feature;

use App\Models\ConsultationRequest;
use App\Services\ConsultationSmsNotifier;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Mockery;
use Tests\TestCase;

class ConsultationLandingPageTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'app.url' => self::SITE_URL,
            'database.default' => 'consultation_test',
            'database.connections.consultation_test' => [
                'driver' => 'sqlite',
                'database' => ':memory:',
                'prefix' => '',
                'foreign_key_constraints' => true,
            ],
        ]);
        DB::purge('consultation_test');
        DB::setDefaultConnection('consultation_test');
        URL::forceRootUrl(self::SITE_URL);
        URL::forceScheme('https');

        Schema::create('consultation_requests', function (Blueprint $table): void {
            $table->id();
            $table->string('name', 100);
            $table->string('company', 150);
            $table->string('mobile', 30);
            $table->string('email', 190)->nullable();
            $table->string('company_type', 100)->nullable();
            $table->string('approximate_users', 30)->nullable();
            $table->string('primary_need', 100)->nullable();
            $table->string('topic', 60)->nullable();
            $table->string('topic_label', 150)->nullable();
            $table->json('answers')->nullable();
            $table->text('message')->nullable();
            $table->string('source_page', 2048)->nullable();
            $table->json('utm_parameters')->nullable();
            $table->timestamps();
        });

        $notifier = Mockery::mock(ConsultationSmsNotifier::class);
        $notifier->shouldReceive('send')->zeroOrMoreTimes();
        $this->app->instance(ConsultationSmsNotifier::class, $notifier);
    }

    public function test_process_review_page_is_indexable_complete_and_uses_six_step_form(): void
    {
        $response = $this->get('/consultation/process-review')->assertOk();
        $content = $response->getContent();

        $response
            ->assertSee('<title>بررسی رایگان فرایندهای شرکت حمل‌ونقل | سپند</title>', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/consultation/process-review">', false)
            ->assertSee('مشاوره رایگان ویژه شرکت‌های حمل‌ونقل بین‌المللی', false)
            ->assertSee('کدام بخش از کار شرکت شما به', false)
            ->assertSee('شروع بررسی رایگان', false)
            ->assertSee('مرحله ۱ از ۶', false)
            ->assertSee('data-stage="6"', false)
            ->assertSee('ادامه بدون توضیح', false)
            ->assertSee('ثبت درخواست بررسی رایگان', false)
            ->assertSee('فروش، مشتریان و استعلام‌ها', false)
            ->assertSee('نرخ‌گیری و ارتباط با تأمین‌کنندگان', false)
            ->assertSee('بوکینگ و هماهنگی حمل', false)
            ->assertSee('عملیات و پیگیری محموله‌ها', false)
            ->assertSee('مدیریت اسناد و مدارک', false)
            ->assertSee('امور مالی و پیگیری تسویه‌ها', false)
            ->assertSee('گزارش‌گیری و نظارت مدیریتی', false)
            ->assertSee('هماهنگی و انتقال اطلاعات بین بخش‌ها', false)
            ->assertSee('consultation_process_step_complete', false)
            ->assertDontSee('name="email"', false)
            ->assertDontSee('name="company_type"', false)
            ->assertDontSee('تضمین', false);

        $this->assertSame(1, substr_count($content, '<h1'));
        preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $content, $structuredData);
        $this->assertNotEmpty($structuredData[1]);
        foreach ($structuredData[1] as $json) {
            $this->assertIsArray(json_decode($json, true, 512, JSON_THROW_ON_ERROR));
        }
    }

    public function test_demo_page_remains_available_separately_from_the_process_review(): void
    {
        $this->get('/consultation')
            ->assertOk()
            ->assertSee('<title>درخواست دمو نرم‌افزار حمل‌ونقل و مشاوره خرید | سپند</title>', false)
            ->assertSee('<link rel="canonical" href="'.self::SITE_URL.'/consultation">', false)
            ->assertSee('درخواست دمو و مشاوره خرید', false)
            ->assertSee('action="'.self::SITE_URL.'/consultation"', false)
            ->assertSee('name="company_type"', false)
            ->assertSee('name="primary_need"', false)
            ->assertDontSee('مرحله ۱ از ۶', false);
    }

    public function test_demo_form_uses_the_original_submission_flow(): void
    {
        $response = $this->post('/consultation', [
            'name' => 'علی رضایی',
            'company' => 'حمل‌ونقل نمونه',
            'mobile' => '09121234567',
            'email' => 'ali@example.com',
            'company_type' => 'شرکت حمل‌ونقل بین‌المللی',
            'approximate_users' => '6 تا 15 نفر',
            'primary_need' => 'CRM و فروش',
            'message' => 'درخواست نمایش فرایند فروش و پیگیری مشتریان.',
        ]);

        $response
            ->assertRedirect(self::SITE_URL.'/consultation')
            ->assertSessionHas('status', 'درخواست شما ثبت شد. اطلاعات اولیه بررسی می‌شود و برای هماهنگی جلسه دمو با شما تماس می‌گیریم.');

        $stored = ConsultationRequest::query()->sole();
        $this->assertSame('شرکت حمل‌ونقل بین‌المللی', $stored->company_type);
        $this->assertSame('CRM و فروش', $stored->primary_need);
        $this->assertNull($stored->topic);
    }

    public function test_form_rejects_an_answer_that_does_not_belong_to_the_selected_path(): void
    {
        $this->from('/consultation/process-review')->post('/consultation/process-review', [
            'topic' => 'sales',
            'responses' => [
                2 => 'accounting_software',
                3 => 'forgotten_followups',
                4 => 'memory',
            ],
            'name' => 'کاربر آزمایشی',
            'mobile' => '۰۹۱۲۱۲۳۴۵۶۷',
            'company' => 'شرکت آزمایشی',
        ])->assertRedirect('/consultation/process-review')
            ->assertSessionHasErrors([
                'responses.2' => 'پاسخ انتخاب‌شده برای این مسیر معتبر نیست.',
            ]);
    }

    public function test_valid_submission_normalizes_mobile_and_stores_structured_answers_and_utm(): void
    {
        $response = $this->post('/consultation/process-review', [
            'topic' => 'operations',
            'responses' => [
                2 => 'mixed',
                3 => 'unknown_latest_status',
                4 => 'ask_owner',
            ],
            'message' => 'پیگیری وضعیت هر پرونده زمان زیادی می‌گیرد.',
            'name' => 'علی رضایی',
            'mobile' => '۰۹۱۲-۱۲۳-۴۵۶۷',
            'company' => 'حمل‌ونقل نمونه',
            'source_page' => self::SITE_URL.'/consultation/process-review?utm_source=google',
            'utm' => [
                'utm_source' => 'google',
                'utm_campaign' => 'process-review',
            ],
        ]);

        $response->assertRedirect(self::SITE_URL.'/consultation/process-review')
            ->assertSessionHas('status', 'success');

        $stored = ConsultationRequest::query()->sole();
        $this->assertSame('09121234567', $stored->mobile);
        $this->assertSame('operations', $stored->topic);
        $this->assertSame('عملیات و پیگیری محموله‌ها', $stored->topic_label);
        $this->assertSame('operations_status_storage', $stored->answers[0]['question_id']);
        $this->assertSame('ترکیبی از چند روش', $stored->answers[0]['answer']);
        $this->assertSame('google', $stored->utm_parameters['utm_source']);

        $this->followRedirects($response)
            ->assertOk()
            ->assertSee('درخواست شما ثبت شد', false)
            ->assertSee('آشنایی بیشتر با سپند', false)
            ->assertDontSee('<form class="consultation-wizard', false);
    }

    public function test_storage_failure_keeps_the_answers_for_a_retry(): void
    {
        Schema::drop('consultation_requests');

        $this->from('/consultation/process-review')->post('/consultation/process-review', [
            'topic' => 'documents',
            'responses' => [
                2 => 'computer_folders',
                3 => 'latest_version',
                4 => 'manual_review',
            ],
            'message' => 'نسخه‌های مختلف سند پراکنده‌اند.',
            'name' => 'کاربر آزمایشی',
            'mobile' => '09121234567',
            'company' => 'شرکت آزمایشی',
        ])->assertRedirect('/consultation/process-review')
            ->assertSessionHasErrors([
                'submission' => 'ثبت درخواست انجام نشد. پاسخ‌های شما حفظ شده‌اند؛ لطفاً دوباره تلاش کنید.',
            ])
            ->assertSessionHasInput('topic', 'documents')
            ->assertSessionHasInput('message', 'نسخه‌های مختلف سند پراکنده‌اند.');
    }

    public function test_consultation_model_casts_process_review_payloads(): void
    {
        $request = new ConsultationRequest;

        $this->assertTrue($request->isFillable('topic'));
        $this->assertTrue($request->isFillable('answers'));
        $this->assertSame('array', $request->getCasts()['answers']);
        $this->assertSame('array', $request->getCasts()['utm_parameters']);
    }
}
