<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_homepage_is_available_to_guests()
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('مسیر تجارت شما')
            ->assertSee('چرا سپند؟')
            ->assertSee('assets/images/brand/sepand-provided-header.png')
            ->assertSee('رهگیری محموله')
            ->assertSee('پورتال مشتریان')
            ->assertSee('پرتال سازمان');
    }

    /** @dataProvider marketingPages */
    public function test_marketing_pages_are_available_to_guests(string $uri, string $content)
    {
        $this->get($uri)
            ->assertOk()
            ->assertSee($content)
            ->assertSee('رهگیری محموله')
            ->assertSee('پورتال مشتریان')
            ->assertSee('پرتال سازمان');
    }

    public static function marketingPages(): array
    {
        return [
            'modules' => ['/modules', 'هر فرایند، یک ماژول'],
            'pricing' => ['/pricing', 'تعرفه‌ای متناسب'],
            'about' => ['/about', 'فناوری وقتی ارزشمند است'],
        ];
    }

    public function test_customer_login_page_is_available_to_guests()
    {
        $this->get('/login')
            ->assertOk()
            ->assertSee('پورتال مشتریان سپند')
            ->assertSee('شماره موبایل یا ایمیل')
            ->assertSee('رمز عبور')
            ->assertSee('ورود به پورتال مشتریان');
    }
}
