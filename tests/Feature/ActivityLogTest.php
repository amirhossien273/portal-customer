<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Tenant;
use App\Tenancy\TenantContext;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\Auth\App\Http\Middleware\CheckPermission;
use Modules\Auth\App\Models\Group;
use Modules\Auth\App\Models\User;
use Tests\TestCase;

class ActivityLogTest extends TestCase
{
    use DatabaseTransactions;

    public function test_model_changes_are_logged_with_uuid_and_isolated_by_tenant(): void
    {
        $defaultTenant = Tenant::query()->where('is_default', true)->firstOrFail();
        $secondTenant = Tenant::query()->create([
            'name' => 'Activity tenant',
            'subdomain' => 'activity-'.strtolower(uniqid()),
            'is_active' => true,
        ]);
        $tenantContext = app(TenantContext::class);

        try {
            $tenantContext->set($defaultTenant);
            $user = User::query()->create($this->userAttributes('09124440001'));
            Activity::query()->delete();
            Auth::login($user);

            $user->update([
                'first_name' => 'ثبت‌شده',
                'password' => bcrypt('changed-password'),
            ]);

            $activity = Activity::query()->sole();

            $this->assertTrue(Str::isUuid($activity->id));
            $this->assertSame($defaultTenant->id, $activity->tenant_id);
            $this->assertSame($user->id, $activity->causer_id);
            $this->assertSame('updated', $activity->event);
            $this->assertSame('ثبت‌شده', $activity->properties->get('attributes')['first_name']);
            $this->assertArrayNotHasKey('password', $activity->properties->get('attributes'));

            $tenantContext->set($secondTenant);
            User::query()->create($this->userAttributes('09124440002'));
            $this->assertSame(1, Activity::query()->count());

            $tenantContext->set($defaultTenant);
            $this->assertSame(1, Activity::query()->count());
        } finally {
            Auth::logout();
            $tenantContext->forget();
        }
    }

    public function test_activity_page_is_available_and_system_logs_require_default_tenant_admin(): void
    {
        $defaultTenant = Tenant::query()->where('is_default', true)->firstOrFail();
        $tenantContext = app(TenantContext::class);

        try {
            $tenantContext->set($defaultTenant);
            $user = User::query()->create($this->userAttributes('09124440003'));

            $this->withoutMiddleware(CheckPermission::class)
                ->actingAs($user)
                ->get(route('activity-logs.index'))
                ->assertOk()
                ->assertSee('گزارش فعالیت‌ها');

            $this->get(route('log-viewer::dashboard'))->assertForbidden();

            $group = Group::query()->firstOrCreate(['name' => 'مدیر سیستم'], ['is_active' => true]);
            $user->groups()->attach($group->id);

            $this->actingAs($user->fresh())
                ->get(route('log-viewer::dashboard'))
                ->assertOk();

            $secondTenant = Tenant::query()->create([
                'name' => 'Restricted logs tenant',
                'subdomain' => 'restricted-logs-'.strtolower(uniqid()),
                'is_active' => true,
            ]);
            $tenantContext->set($secondTenant);
            $tenantUser = User::query()->create($this->userAttributes('09124440004'));
            $tenantAdminGroup = Group::query()->create(['name' => 'مدیر سیستم', 'is_active' => true]);
            $tenantUser->groups()->attach($tenantAdminGroup->id);

            $this->actingAs($tenantUser)
                ->get(route('log-viewer::dashboard'))
                ->assertForbidden();
        } finally {
            Auth::logout();
            $tenantContext->forget();
        }
    }

    private function userAttributes(string $mobile): array
    {
        return [
            'first_name' => 'کاربر',
            'last_name' => 'لاگ',
            'mobile' => $mobile,
            'password' => bcrypt('password'),
        ];
    }
}
