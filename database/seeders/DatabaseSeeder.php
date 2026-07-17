<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Tenancy\TenantContext;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TenantSeeder::class);

        $tenantContext = app(TenantContext::class);
        $tenantContext->set(Tenant::query()->where('is_default', true)->firstOrFail());

        try {
            $this->call(TenantDatabaseSeeder::class);
        } finally {
            $tenantContext->forget();
        }
    }
}
