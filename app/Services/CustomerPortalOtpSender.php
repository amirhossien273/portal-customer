<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class CustomerPortalOtpSender
{
    public function send(string $mobile, string $otp): void
    {
        $apiKey = trim((string) config('services.farazsms.api_key'));
        $lineNumber = $this->normalizeLineNumber((string) config('services.farazsms.line_number'));
        $patternCode = trim((string) config('customer_portal.otp.pattern_code'));

        if ($apiKey === '' || $lineNumber === '' || $patternCode === '') {
            throw new RuntimeException('Customer portal OTP delivery is not configured.');
        }

        Http::baseUrl(rtrim((string) config('services.farazsms.url'), '/'))
            ->acceptJson()
            ->asJson()
            ->withHeaders(['Api-Key' => $apiKey])
            ->timeout(max(1, (int) config('services.farazsms.timeout', 20)))
            ->post('/ws/v1/sms/pattern', [
                'code' => $patternCode,
                'attributes' => ['code' => $otp],
                'recipient' => $mobile,
                'line_number' => $lineNumber,
                'number_format' => 'english',
            ])
            ->throw();
    }

    private function normalizeLineNumber(string $lineNumber): string
    {
        $digits = preg_replace('/\D+/', '', $lineNumber) ?? '';

        if (str_starts_with($digits, '0098')) {
            return substr($digits, 4);
        }

        return str_starts_with($digits, '98') ? substr($digits, 2) : $digits;
    }
}
