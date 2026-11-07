<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class ConsultationSmsNotifier
{
    private const RECIPIENT = '09197340692';

    private const MESSAGE = 'یک درخواست برای نرم افزار سپند ثبت شد';

    public function send(): void
    {
        $apiKey = config('services.farazsms.api_key');
        $lineNumber = config('services.farazsms.line_number');

        if (blank($apiKey) || blank($lineNumber)) {
            Log::warning('Consultation SMS was not sent because Faraz SMS is not configured.');

            return;
        }

        try {
            Http::baseUrl(rtrim((string) config('services.farazsms.url'), '/'))
                ->acceptJson()
                ->asJson()
                ->withHeaders(['Api-Key' => (string) $apiKey])
                ->timeout(max(1, (int) config('services.farazsms.timeout', 20)))
                ->post('/ws/v1/sms/simple', [
                    'text' => self::MESSAGE,
                    'recipients' => [self::RECIPIENT],
                    'line_number' => $this->normalizeLineNumber((string) $lineNumber),
                    'number_format' => 'persian',
                ])
                ->throw();
        } catch (Throwable $exception) {
            Log::warning('Consultation SMS could not be sent.', [
                'error' => $exception->getMessage(),
            ]);
        }
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
