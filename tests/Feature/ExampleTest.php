<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_homepage_is_available_to_guests(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('مسیر هوشمند تجارت شما')
            ->assertSee('چرا سپند؟')
            ->assertSee('assets/images/brand/sepand-provided-header.png')
            ->assertSee('رهگیری محموله')
            ->assertSee('پورتال مشتریان')
            ->assertSee('پرتال سازمان');
    }

    /** @dataProvider marketingPages */
    public function test_marketing_pages_are_available_to_guests(string $uri, string $content): void
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
            'modules' => ['/modules', 'ماژول‌های یکپارچه سپند'],
            'pricing' => ['/pricing', 'قیمت و تعرفه'],
            'about' => ['/about', 'فناوری وقتی ارزشمند است'],
        ];
    }

    public function test_customer_login_page_is_available_to_guests(): void
    {
        $this->get('/login')
            ->assertOk()
            ->assertSee('پورتال مشتریان سپند')
            ->assertSee('شماره موبایل')
            ->assertSee('دریافت کد ورود')
            ->assertSee('ورود بدون رمز عبور');
    }
}
