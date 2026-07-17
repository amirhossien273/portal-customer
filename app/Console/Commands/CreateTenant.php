<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use App\Tenancy\TenantContext;
use Database\Seeders\TenantDatabaseSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\Auth\App\Models\Group;
use Spatie\Activitylog\Facades\Activity;
use Throwable;

class CreateTenant extends Command
{
    protected $signature = 'tenant:create
                            {name? : Tenant display name}
                            {subdomain? : Tenant subdomain, without the central domain}
                            {--mobile= : Administrator mobile number}
                            {--password= : Administrator password; omit to enter it securely}';

    protected $description = 'Create a tenant and seed all of its initial data and access permissions';

    public function handle(TenantContext $tenantContext): int
    {
        if (! Schema::hasTable('tenants') || ! Schema::hasColumn('users', 'tenant_id')) {
            $this->error('Tenancy migrations have not been run. Run "php artisan migrate" first.');

            return self::FAILURE;
        }

        $name = trim((string) ($this->argument('name') ?: $this->ask('Tenant name')));
        $subdomain = Str::lower(trim((string) ($this->argument('subdomain') ?: $this->ask('Tenant subdomain'))));
        $mobile = trim((string) ($this->option('mobile') ?: $this->ask('Administrator mobile')));
        $password = (string) ($this->option('password') ?: $this->secret('Administrator password'));

        if ($name === '') {
            $this->error('Tenant name is required.');

            return self::INVALID;
        }

        if (! $this->isValidSubdomain($subdomain)) {
            $this->error('Subdomain must be a single DNS label containing only letters, numbers, and hyphens.');

            return self::INVALID;
        }

        $credentialsValidator = Validator::make(
            ['mobile' => $mobile, 'password' => $password],
            [
                'mobile' => ['required', 'regex:/^09\d{9}$/'],
                'password' => ['required', 'string', 'min:6', 'max:255'],
            ],
            [
                'mobile.required' => 'Administrator mobile is required.',
                'mobile.regex' => 'Administrator mobile must be an 11-digit Iranian mobile number starting with 09.',
                'password.required' => 'Administrator password is required.',
                'password.min' => 'Administrator password must contain at least 6 characters.',
            ]
        );

        if ($credentialsValidator->fails()) {
            $this->error($credentialsValidator->errors()->first());

            return self::INVALID;
        }

        if (Tenant::query()->where('subdomain', $subdomain)->exists()) {
            $this->error("A tenant with subdomain [{$subdomain}] already exists.");

            return self::FAILURE;
        }

        $previousTenant = $tenantContext->current();

        try {
            $tenant = DB::transaction(function () use ($name, $subdomain, $mobile, $password, $tenantContext): Tenant {
                $tenant = Tenant::query()->create([
                    'name' => $name,
                    'subdomain' => $subdomain,
                    'is_default' => false,
                    'is_active' => true,
                ]);

                $tenantContext->set($tenant);

                $this->components->info("Seeding data for tenant [{$tenant->name}]...");

                $seeder = app(TenantDatabaseSeeder::class);
                $seeder->setContainer($this->laravel)->setCommand($this);
                $seeder();

                $this->configureAdministrator($mobile, $password);

                return $tenant;
            });
        } catch (Throwable $exception) {
            $this->error('Tenant creation failed: '.$exception->getMessage());

            return self::FAILURE;
        } finally {
            if ($previousTenant) {
                $tenantContext->set($previousTenant);
            } else {
                $tenantContext->forget();
            }
        }

        $this->newLine();
        $this->components->info("Tenant [{$tenant->name}] created successfully.");
        $this->line("Subdomain: {$tenant->subdomain}");
        $this->line("Tenant ID: {$tenant->getKey()}");
        $this->line("Administrator mobile: {$mobile}");

        return self::SUCCESS;
    }

    private function isValidSubdomain(string $subdomain): bool
    {
        return preg_match('/^(?!-)[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?$/', $subdomain) === 1;
    }

    private function configureAdministrator(string $mobile, string $password): void
    {
        $administrator = Group::query()->where('name', 'مدیر سیستم')->firstOrFail();
        $user = $administrator->users()->firstOrFail();

        Activity::withoutLogs(fn () => $user->update([
            'mobile' => $mobile,
            'password' => Hash::make($password),
        ]));
    }
}
