<?php

namespace Tests\Feature;

use App\Services\ConsultationSmsNotifier;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ConsultationSmsNotifierTest extends TestCase
{
    public function test_it_sends_the_fixed_consultation_message_only_to_the_requested_number(): void
    {
        config([
            'services.farazsms.url' => 'https://api.iranpayamak.test',
            'services.farazsms.api_key' => 'test-api-key',
            'services.farazsms.line_number' => '983000505',
            'services.farazsms.timeout' => 20,
        ]);
        Http::fake([
            'https://api.iranpayamak.test/ws/v1/sms/simple' => Http::response([
                'status' => 'success',
            ], 201),
        ]);

        app(ConsultationSmsNotifier::class)->send();

        Http::assertSentCount(1);
        Http::assertSent(fn (Request $request): bool => $request->url() === 'https://api.iranpayamak.test/ws/v1/sms/simple'
            && $request->hasHeader('Api-Key', 'test-api-key')
            && $request['text'] === 'یک درخواست برای نرم افزار سپند ثبت شد'
            && $request['recipients'] === ['09197340692']
            && $request['line_number'] === '3000505'
            && $request['number_format'] === 'persian'
        );
    }

    public function test_it_does_not_make_a_request_when_faraz_sms_is_not_configured(): void
    {
        config([
            'services.farazsms.api_key' => null,
            'services.farazsms.line_number' => null,
        ]);
        Http::fake();

        app(ConsultationSmsNotifier::class)->send();

        Http::assertNothingSent();
    }
}
