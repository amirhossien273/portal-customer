<?php

namespace App\Support;

use Carbon\Carbon;
use Morilog\Jalali\Jalalian;
use Throwable;

final class CustomerPortalPresenter
{
    /** @return array{label: string, tone: string} */
    public static function inquiryStatus(?string $status): array
    {
        return match ($status) {
            'success' => ['label' => 'تأیید و نهایی‌شده', 'tone' => 'success'],
            'failed' => ['label' => 'بسته‌شده', 'tone' => 'danger'],
            'proforma_invoice' => ['label' => 'پیش‌فاکتور صادر شده', 'tone' => 'info'],
            default => ['label' => 'در حال بررسی', 'tone' => 'warning'],
        };
    }

    /** @return array{label: string, tone: string} */
    public static function bookingStatus(?string $status): array
    {
        return match ($status) {
            'operational' => ['label' => 'در عملیات', 'tone' => 'info'],
            'completed' => ['label' => 'تکمیل‌شده', 'tone' => 'success'],
            'rejected', 'canceled' => ['label' => 'متوقف‌شده', 'tone' => 'danger'],
            default => ['label' => 'در انتظار شروع', 'tone' => 'warning'],
        };
    }

    /** @return array{label: string, tone: string} */
    public static function trackingStatus(?string $status): array
    {
        return match ($status) {
            'completed' => ['label' => 'انجام‌شده', 'tone' => 'success'],
            'delayed' => ['label' => 'دارای تأخیر', 'tone' => 'danger'],
            'cancelled' => ['label' => 'لغوشده', 'tone' => 'muted'],
            default => ['label' => 'در انتظار', 'tone' => 'warning'],
        };
    }

    /** @return array{label: string, tone: string} */
    public static function invoiceStatus(?string $status): array
    {
        return match ($status) {
            'paid' => ['label' => 'پرداخت‌شده', 'tone' => 'success'],
            'issued', 'sent' => ['label' => 'صادرشده', 'tone' => 'info'],
            'cancelled' => ['label' => 'لغوشده', 'tone' => 'danger'],
            default => ['label' => 'پیش‌نویس', 'tone' => 'muted'],
        };
    }

    public static function shippingMode(?string $mode): string
    {
        return match ($mode) {
            'sea' => 'حمل دریایی',
            'air' => 'حمل هوایی',
            'road' => 'حمل زمینی',
            'rail' => 'حمل ریلی',
            default => 'نوع حمل ثبت نشده',
        };
    }

    public static function date(mixed $value, bool $withTime = false): string
    {
        if (blank($value)) {
            return '—';
        }

        try {
            $date = $value instanceof Carbon ? $value : Carbon::parse($value);

            return Jalalian::fromCarbon($date)->format($withTime ? 'Y/m/d، H:i' : 'Y/m/d');
        } catch (Throwable) {
            return (string) $value;
        }
    }

    public static function routePoint(mixed $value, string $fallback = 'نامشخص'): string
    {
        $parts = collect(is_array($value) ? $value : [$value])
            ->filter(fn ($part) => filled($part))
            ->unique()
            ->values();

        return $parts->isEmpty() ? $fallback : $parts->join('، ');
    }
}
