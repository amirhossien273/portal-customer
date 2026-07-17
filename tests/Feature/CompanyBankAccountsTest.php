<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Cache;
use Modules\Accounting\App\Models\Receipt;
use Modules\Auth\App\Models\User;
use Modules\Shared\App\Models\Setting;
use Tests\TestCase;

class CompanyBankAccountsTest extends TestCase
{
    use DatabaseTransactions;

    protected function tearDown(): void
    {
        Cache::forget('settings.all');
        parent::tearDown();
    }

    public function test_multiple_company_bank_accounts_are_normalized_and_saved(): void
    {
        $response = $this->put(route('settings.company.update'), [
            'company_name' => 'شرکت سپند',
            'bank_accounts' => [
                [
                    'title' => 'بانک ملت - جاری',
                    'account_number' => '۰۱۱۹۳۳۵۹۲۵۰۰۸',
                    'card_number' => '6037 9988 0043 0687',
                    'sheba_number' => '۷۰۰۱۷۰۰۰۰۰۰۰۱۱۹۳۳۵۹۲۵۰۰۸',
                ],
                [
                    'title' => 'بانک سامان - درآمد',
                    'account_number' => '987654321',
                    'card_number' => '6219861034567890',
                    'sheba_number' => 'IR120560000000987654321001',
                ],
            ],
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        Cache::forget('settings.all');
        $company = Setting::where('key', 'setting_company')->firstOrFail()->value;
        $this->assertCount(2, $company['bank_accounts']);
        $this->assertSame('0119335925008', $company['bank_accounts'][0]['account_number']);
        $this->assertSame('6037998800430687', $company['bank_accounts'][0]['card_number']);
        $this->assertSame('IR700170000000119335925008', $company['bank_accounts'][0]['sheba_number']);
        $this->assertSame('6037998800430687', $company['card_info']);
        $this->assertSame('0119335925008', $company['account_number']);
        $this->assertSame('IR700170000000119335925008', $company['sheba_number']);

        $options = Receipt::companyAccounts();
        $this->assertCount(2, $options);
        $this->assertSame('بانک ملت - جاری', $options['bank_0_account']['label']);
        $this->assertSame('987654321', $options['bank_1_account']['number']);
        $this->assertSame('account_number', $options['bank_1_account']['type']);
        $this->assertArrayNotHasKey('bank_0_card', $options);
        $this->assertArrayNotHasKey('bank_0_iban', $options);
    }

    public function test_company_settings_page_renders_multiple_account_editor_and_rejects_duplicates(): void
    {
        $user = User::create([
            'first_name' => 'کاربر',
            'last_name' => 'تنظیمات',
            'mobile' => '0912'.random_int(1000000, 9999999),
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user)->get(route('settings.company.edit'))
            ->assertOk()
            ->assertSee('حساب‌های بانکی شرکت')
            ->assertSee('افزودن حساب جدید')
            ->assertSee('company-bank-section', false);

        $this->from(route('settings.company.edit'))
            ->put(route('settings.company.update'), [
                'company_name' => 'شرکت سپند',
                'bank_accounts' => [
                    ['title' => 'حساب اول', 'card_number' => '6037998800430687'],
                    ['title' => 'حساب دوم', 'card_number' => '6037998800430687'],
                ],
            ])
            ->assertRedirect(route('settings.company.edit'))
            ->assertSessionHasErrors(['bank_accounts']);
    }
}
