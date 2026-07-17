<?php

namespace Database\Seeders;

use App\Tenancy\TenantContext;
use Illuminate\Database\Seeder;
use Modules\Auth\Database\Seeders\AuthDatabaseSeeder;
use Modules\Auth\Database\Seeders\SeedFakeAuthUsersSeeder;
use Modules\Booking\Database\Seeders\BookingDatabaseSeeder;
use Modules\Customer\Database\Seeders\CustomerDatabaseSeeder;
use Modules\Customer\Database\Seeders\TagSeeder;
use Modules\Flow\Database\Seeders\FlowDatabaseSeeder;
use Modules\Product\Database\Seeders\ProductDatabaseSeeder;
use Modules\Shared\Database\Seeders\SettingSeeder;
use Modules\Transaction\Database\Seeders\TransactionDatabaseSeeder;
use Spatie\Activitylog\Facades\Activity;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Seed all shared reference data and tenant-owned initial data.
     */
    public function run(): void
    {
        // Prevent this seeder from accidentally updating data across tenants.
        app(TenantContext::class)->get();

        Activity::withoutLogs(fn () => $this->call([
            AuthDatabaseSeeder::class,
            CustomerDatabaseSeeder::class,
            TransactionDatabaseSeeder::class,
            SeedFakeAuthUsersSeeder::class,
            ProductDatabaseSeeder::class,
            FlowDatabaseSeeder::class,
            BookingDatabaseSeeder::class,
            TagSeeder::class,
            SettingSeeder::class,
        ]));
    }
}
