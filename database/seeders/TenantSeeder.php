<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function (): void {
            $subdomain = (string) config('tenancy.default_tenant.subdomain');

            Tenant::query()
                ->where('is_default', true)
                ->where('subdomain', '!=', $subdomain)
                ->update(['is_default' => false]);

            Tenant::query()->updateOrCreate(
                ['subdomain' => $subdomain],
                [
                    'id' => (string) config('tenancy.default_tenant.id'),
                    'name' => (string) config('tenancy.default_tenant.name'),
                    'is_default' => true,
                    'is_active' => true,
                ]
            );
        });
    }
}
