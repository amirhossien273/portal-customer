<?php

namespace Tests\Feature;

use App\Models\Tenant;
use App\Tenancy\TenantContext;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Auth\App\Http\Middleware\CheckPermission;
use Modules\Auth\App\Models\User;
use Tests\TestCase;

class FlowPagesJavaScriptTest extends TestCase
{
    use DatabaseTransactions;

    public function test_flow_pages_render_uuid_values_as_valid_javascript_strings(): void
    {
        $this->withoutVite();
        $this->withoutMiddleware(CheckPermission::class);

        $tenantContext = app(TenantContext::class);
        $tenantContext->set(Tenant::query()->where('is_default', true)->firstOrFail());

        try {
            $user = User::query()->firstOrFail();

            foreach (['transaction.flow', 'transaction.myFlow', 'booking.flow', 'operation.flow'] as $routeName) {
                $content = $this->actingAs($user)
                    ->get(route($routeName))
                    ->assertOk()
                    ->getContent();

                $this->assertDoesNotMatchRegularExpression(
                    '/\bid:\s*[0-9a-f]{8}-[0-9a-f-]{27,}/i',
                    $content,
                    "Route [{$routeName}] contains an unquoted UUID in JavaScript."
                );
                $this->assertMatchesRegularExpression(
                    '/\bid:\s*"[0-9a-f]{8}-[0-9a-f-]{27,}"/i',
                    $content,
                    "Route [{$routeName}] did not render its UUID as a JavaScript string."
                );
            }
        } finally {
            $tenantContext->forget();
        }
    }
}
