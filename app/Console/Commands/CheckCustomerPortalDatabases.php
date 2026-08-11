<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Throwable;

class CheckCustomerPortalDatabases extends Command
{
    protected $signature = 'portal:check-databases';

    protected $description = 'Verify the independent portal and Sepand CRM database connections';

    public function handle(): int
    {
        $siteConnection = (string) config('database.default');
        $crmConnection = (string) config('customer_portal.connection', 'crm');

        if ($siteConnection === '' || $crmConnection === '') {
            $this->error('نام اتصال دیتابیس داخلی پرتال یا CRM تنظیم نشده است.');

            return self::FAILURE;
        }

        if ($siteConnection === $crmConnection) {
            $this->error('اتصال دیتابیس داخلی پرتال و CRM باید دو اتصال مجزا باشند.');

            return self::FAILURE;
        }

        try {
            $site = DB::connection($siteConnection);
            $crm = DB::connection($crmConnection);

            if ($this->fingerprint($site) === $this->fingerprint($crm)) {
                $this->error('هر دو اتصال به یک دیتابیس اشاره می‌کنند؛ DB_* و CRM_DB_* را اصلاح کنید.');

                return self::FAILURE;
            }

            $site->getPdo();
            $crm->getPdo();
        } catch (Throwable $exception) {
            $this->error('برقراری اتصال دیتابیس ناموفق بود: '.$exception->getMessage());

            return self::FAILURE;
        }

        $missingSiteTables = $this->missingTables(
            $siteConnection,
            config('customer_portal.site_required_tables', [])
        );
        $missingCrmTables = $this->missingTables(
            $crmConnection,
            config('customer_portal.crm_required_tables', [])
        );

        if ($missingSiteTables !== []) {
            $this->error('جدول‌های دیتابیس داخلی پرتال موجود نیستند: '.implode(', ', $missingSiteTables));
            $this->line('برای دیتابیس داخلی پرتال دستور php artisan migrate را اجرا کنید.');

            return self::FAILURE;
        }

        if ($missingCrmTables !== []) {
            $this->error('جدول‌های موردنیاز در دیتابیس Sepand CRM موجود نیستند: '.implode(', ', $missingCrmTables));

            return self::FAILURE;
        }

        $this->table(
            ['نقش', 'اتصال', 'دیتابیس', 'وضعیت'],
            [
                ['دیتابیس داخلی پرتال', $siteConnection, $site->getDatabaseName(), 'متصل'],
                ['دیتابیس Sepand CRM', $crmConnection, $crm->getDatabaseName(), 'متصل'],
            ]
        );
        $this->info('هر دو دیتابیس مستقل، قابل دسترس و دارای جدول‌های موردنیاز هستند.');

        return self::SUCCESS;
    }

    private function fingerprint(Connection $connection): string
    {
        $config = $connection->getConfig();

        return implode('|', [
            strtolower((string) ($config['driver'] ?? '')),
            strtolower((string) ($config['host'] ?? '')),
            (string) ($config['port'] ?? ''),
            strtolower((string) ($config['database'] ?? '')),
        ]);
    }

    /**
     * @param  array<int, string>  $tables
     * @return array<int, string>
     */
    private function missingTables(string $connection, array $tables): array
    {
        return array_values(array_filter(
            $tables,
            fn (string $table): bool => ! Schema::connection($connection)->hasTable($table)
        ));
    }
}
