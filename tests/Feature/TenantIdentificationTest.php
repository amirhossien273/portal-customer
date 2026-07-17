<?php

namespace Tests\Feature;

use App\Models\Tenant;
use App\Tenancy\TenantContext;
use App\Tenancy\TenantResolver;
use Database\Seeders\TenantSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\Auth\App\Models\Group;
use Modules\Auth\App\Models\User;
use Modules\Flow\App\Models\Flow;
use Modules\Shared\App\Models\Setting;
use Tests\TestCase;

class TenantIdentificationTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('tenancy.central_domains', ['crm.test', 'localhost']);

        Route::get('/_testing/current-tenant', function (Request $request) {
            return response()->json([
                'id' => $request->attributes->get('tenant')->id,
                'current_id' => Tenant::current()?->id,
            ]);
        });
    }

    public function test_registered_subdomain_resolves_its_active_tenant(): void
    {
        $this->makeDefaultTenant();
        $tenant = Tenant::create([
            'name' => 'Acme',
            'subdomain' => 'acme',
            'is_active' => true,
        ]);

        $this->getJson('http://acme.crm.test/_testing/current-tenant')
            ->assertOk()
            ->assertJson([
                'id' => $tenant->id,
                'current_id' => $tenant->id,
            ]);

        $this->assertNull(app(TenantContext::class)->current());
    }

    public function test_bare_domain_resolves_the_seeded_default_tenant(): void
    {
        $defaultTenant = $this->makeDefaultTenant();

        $this->getJson('http://crm.test/_testing/current-tenant')
            ->assertOk()
            ->assertJsonPath('id', $defaultTenant->id);
    }

    /**
     * @dataProvider ipHostProvider
     */
    public function test_ip_host_resolves_the_seeded_default_tenant(string $host): void
    {
        $defaultTenant = $this->makeDefaultTenant();

        $this->getJson("http://{$host}/_testing/current-tenant")
            ->assertOk()
            ->assertJsonPath('id', $defaultTenant->id);
    }

    public static function ipHostProvider(): array
    {
        return [
            'normal loopback address' => ['127.0.0.1'],
            'requested loopback address' => ['127.0.0.0'],
            'ipv6 loopback address' => ['[::1]'],
        ];
    }

    public function test_unknown_or_inactive_subdomain_is_not_fallen_back_to_default(): void
    {
        $this->makeDefaultTenant();
        Tenant::create([
            'name' => 'Disabled',
            'subdomain' => 'disabled',
            'is_active' => false,
        ]);

        $this->getJson('http://unknown.crm.test/_testing/current-tenant')
            ->assertNotFound();

        $this->getJson('http://disabled.crm.test/_testing/current-tenant')
            ->assertNotFound();
    }

    public function test_host_outside_the_configured_central_domains_is_rejected(): void
    {
        $this->makeDefaultTenant();

        $this->getJson('http://crm.attacker.test/_testing/current-tenant')
            ->assertNotFound();
    }

    public function test_resolver_extracts_only_one_valid_subdomain_label(): void
    {
        $resolver = app(TenantResolver::class);

        $this->assertSame('acme', $resolver->subdomainFromHost('ACME.crm.test.'));
        $this->assertNull($resolver->subdomainFromHost('crm.test'));
        $this->assertSame('', $resolver->subdomainFromHost('nested.acme.crm.test'));
    }

    public function test_tenant_seeder_is_idempotent_and_creates_the_default_tenant(): void
    {
        Tenant::query()->delete();

        config()->set('tenancy.default_tenant', [
            'name' => 'Sepand CRM',
            'subdomain' => 'default',
        ]);

        $seeder = app(TenantSeeder::class);
        $seeder->run();
        $seeder->run();

        $this->assertDatabaseCount('tenants', 1);
        $this->assertDatabaseHas('tenants', [
            'name' => 'Sepand CRM',
            'subdomain' => 'default',
            'is_default' => true,
            'is_active' => true,
        ]);
    }

    public function test_tenant_models_are_automatically_assigned_and_globally_scoped(): void
    {
        $firstTenant = $this->makeDefaultTenant();
        $secondTenant = Tenant::create([
            'name' => 'Second tenant',
            'subdomain' => 'second-'.strtolower(uniqid()),
            'is_active' => true,
        ]);
        $tenantContext = app(TenantContext::class);

        try {
            $tenantContext->set($firstTenant);
            $firstUser = User::create($this->userAttributes('09120000000'));

            $this->assertTrue(Str::isUuid($firstTenant->id));
            $this->assertTrue(Str::isUuid($firstUser->id));
            $this->assertSame($firstTenant->id, $firstUser->tenant_id);
            $this->assertTrue(User::whereKey($firstUser->id)->exists());

            $tenantContext->set($secondTenant);

            $this->assertFalse(User::whereKey($firstUser->id)->exists());
            $secondUser = User::create($this->userAttributes('09120000000'));
            $this->assertSame($secondTenant->id, $secondUser->tenant_id);
            $this->assertSame(1, User::count());

            $tenantContext->set($firstTenant);
            $this->assertSame([$firstUser->id], User::pluck('id')->all());
        } finally {
            $tenantContext->forget();
        }
    }

    public function test_exists_validation_and_pivot_records_are_tenant_aware(): void
    {
        $firstTenant = $this->makeDefaultTenant();
        $secondTenant = Tenant::create([
            'name' => 'Second tenant',
            'subdomain' => 'validation-'.strtolower(uniqid()),
            'is_active' => true,
        ]);
        $tenantContext = app(TenantContext::class);

        try {
            $tenantContext->set($firstTenant);
            $user = User::create($this->userAttributes('09121111111'));
            $group = Group::create(['name' => 'First tenant group', 'is_active' => true]);
            $user->groups()->attach($group->id);

            $this->assertDatabaseHas('user_has_groups', [
                'tenant_id' => $firstTenant->id,
                'user_id' => $user->id,
                'group_id' => $group->id,
            ]);

            $tenantContext->set($secondTenant);
            $this->assertTrue(Validator::make(
                ['user_id' => $user->id],
                ['user_id' => ['exists:users,id']]
            )->fails());

            $tenantContext->set($firstTenant);
            $this->assertFalse(Validator::make(
                ['user_id' => $user->id],
                ['user_id' => ['exists:users,id']]
            )->fails());
        } finally {
            $tenantContext->forget();
        }
    }

    public function test_setting_cache_is_isolated_per_tenant(): void
    {
        $firstTenant = $this->makeDefaultTenant();
        $secondTenant = Tenant::create([
            'name' => 'Second tenant',
            'subdomain' => 'settings-'.strtolower(uniqid()),
            'is_active' => true,
        ]);
        $tenantContext = app(TenantContext::class);
        $key = 'tenant-test-'.strtolower(uniqid());

        try {
            $tenantContext->set($firstTenant);
            Setting::create(['key' => $key, 'value' => 'first']);
            $this->assertSame('first', setting($key));

            $tenantContext->set($secondTenant);
            Setting::create(['key' => $key, 'value' => 'second']);
            $this->assertSame('second', setting($key));

            $tenantContext->set($firstTenant);
            $this->assertSame('first', setting($key));
        } finally {
            $tenantContext->forget();
        }
    }

    public function test_create_tenant_command_seeds_data_admin_user_and_permissions(): void
    {
        $subdomain = 'command-'.strtolower(uniqid());
        $mobile = '09129998877';
        $password = 'tenant-secret';

        $this->artisan('tenant:create', [
            'name' => 'Command tenant',
            'subdomain' => $subdomain,
            '--mobile' => $mobile,
            '--password' => $password,
        ])->assertSuccessful();

        $tenant = Tenant::query()->where('subdomain', $subdomain)->firstOrFail();

        $this->assertTrue(Str::isUuid($tenant->id));
        $this->assertFalse($tenant->is_default);
        $this->assertTrue($tenant->is_active);
        $this->assertNull(app(TenantContext::class)->current());

        app(TenantContext::class)->set($tenant);

        try {
            $administrator = Group::query()->where('name', 'مدیر سیستم')->firstOrFail();
            $user = User::query()->where('mobile', $mobile)->firstOrFail();

            $this->assertTrue(Str::isUuid($administrator->id));
            $this->assertTrue(Str::isUuid($user->id));
            $this->assertTrue(Hash::check($password, $user->password));
            $this->assertFalse(User::query()->where('mobile', '09122114604')->exists());
            $this->assertTrue($user->groups()->whereKey($administrator->id)->exists());
            $this->assertGreaterThan(0, $administrator->permissions()->count());
            $this->assertSame($user->id, Flow::query()->where('slug', 'transaction')->value('created_by'));

            $this->assertDatabaseHas('group_has_permissions', [
                'tenant_id' => $tenant->id,
                'group_id' => $administrator->id,
            ]);
            $this->assertDatabaseHas('group_menu_has_permissions', [
                'tenant_id' => $tenant->id,
                'group_id' => $administrator->id,
            ]);
            $this->assertDatabaseHas('settings', [
                'tenant_id' => $tenant->id,
                'key' => 'setting_company',
            ]);
            $this->assertDatabaseHas('provinces', ['tenant_id' => $tenant->id]);
            $this->assertDatabaseHas('cities', ['tenant_id' => $tenant->id]);
            $this->assertDatabaseHas('lo_countries', [
                'tenant_id' => $tenant->id,
                'iso2' => 'IR',
            ]);
            $this->assertDatabaseHas('lo_cities', ['tenant_id' => $tenant->id]);
            $this->assertDatabaseHas('menus', ['tenant_id' => $tenant->id]);
        } finally {
            app(TenantContext::class)->forget();
        }
    }

    public function test_create_tenant_command_rejects_invalid_administrator_credentials(): void
    {
        $subdomain = 'invalid-command-'.strtolower(uniqid());

        $this->artisan('tenant:create', [
            'name' => 'Invalid command tenant',
            'subdomain' => $subdomain,
            '--mobile' => '1234',
            '--password' => '123',
        ])->assertExitCode(2);

        $this->assertFalse(Tenant::query()->where('subdomain', $subdomain)->exists());
    }

    private function makeDefaultTenant(): Tenant
    {
        Tenant::query()->where('is_default', true)->update(['is_default' => false]);

        return Tenant::create([
            'name' => 'Default tenant',
            'subdomain' => 'default-'.strtolower(uniqid()),
            'is_default' => true,
            'is_active' => true,
        ]);
    }

    private function userAttributes(string $mobile): array
    {
        return [
            'first_name' => 'Tenant',
            'last_name' => 'User',
            'mobile' => $mobile,
            'password' => bcrypt('password'),
        ];
    }
}
