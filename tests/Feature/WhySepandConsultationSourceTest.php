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

class WhySepandConsultationSourceTest extends TestCase
{
    private const SITE_URL = 'https://sepandcrm.ir';

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'app.url' => self::SITE_URL,
            'database.default' => 'why_sepand_test',
            'database.connections.why_sepand_test' => ['driver' => 'sqlite', 'database' => ':memory:', 'prefix' => '', 'foreign_key_constraints' => true],
        ]);
        DB::purge('why_sepand_test');
        DB::setDefaultConnection('why_sepand_test');
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
            $table->text('message')->nullable();
            $table->string('source_page', 2048)->nullable();
            $table->timestamps();
        });

        $notifier = Mockery::mock(ConsultationSmsNotifier::class);
        $notifier->shouldReceive('send')->zeroOrMoreTimes();
        $this->app->instance(ConsultationSmsNotifier::class, $notifier);
    }

    public function test_why_sepand_source_is_carried_stored_and_kept_on_success_tracking(): void
    {
        $sourcePage = self::SITE_URL.'/why-sepand';

        $this->get('/consultation?source_page='.rawurlencode($sourcePage))
            ->assertOk()
            ->assertSee('name="source_page" value="'.$sourcePage.'"', false);

        $this->post('/consultation', [
            'name' => 'مدیر فروش',
            'company' => 'فورواردری نمونه',
            'mobile' => '09121234567',
            'company_type' => 'شرکت فورواردری',
            'primary_need' => 'یکپارچه‌سازی فرایندها',
            'source_page' => $sourcePage,
        ])->assertRedirect(self::SITE_URL.'/consultation');

        $this->assertSame($sourcePage, ConsultationRequest::query()->sole()->source_page);

        $this->withSession(['status' => 'درخواست شما ثبت شد. اطلاعات اولیه بررسی می‌شود و برای هماهنگی جلسه دمو با شما تماس می‌گیریم.'])
            ->get('/consultation?source_page='.rawurlencode($sourcePage))
            ->assertOk()
            ->assertSee("window.gtag('event','consultation_success'", false)
            ->assertSee("event_label:'consultation_form_success'", false);
    }
}
