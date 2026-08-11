<?php

namespace Tests\Feature;

use App\Models\ConsultationRequest;
use App\Models\Crm\CustomerPersonal;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CustomerPortalDatabaseConnectionsTest extends TestCase
{
    private const SITE_CONNECTION = 'portal_testing';

    private const CRM_CONNECTION = 'crm_testing';

    private string $siteDatabase;

    private string $crmDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->siteDatabase = $this->temporaryDatabase('sepand-portal-site-');
        $this->crmDatabase = $this->temporaryDatabase('sepand-portal-crm-');

        config([
            'database.default' => self::SITE_CONNECTION,
            'database.connections.'.self::SITE_CONNECTION => $this->sqliteConnection($this->siteDatabase),
            'database.connections.'.self::CRM_CONNECTION => $this->sqliteConnection($this->crmDatabase),
            'customer_portal.connection' => self::CRM_CONNECTION,
            'customer_portal.site_required_tables' => ['migrations', 'activity_log', 'consultation_requests'],
            'customer_portal.crm_required_tables' => ['customers', 'customer_personal'],
        ]);

        DB::purge(self::SITE_CONNECTION);
        DB::purge(self::CRM_CONNECTION);

        $this->createSiteSchema();
        $this->createCrmSchema();
    }

    protected function tearDown(): void
    {
        DB::purge(self::SITE_CONNECTION);
        DB::purge(self::CRM_CONNECTION);

        foreach ([$this->siteDatabase, $this->crmDatabase] as $database) {
            if (is_file($database)) {
                unlink($database);
            }
        }

        parent::tearDown();
    }

    public function test_portal_and_crm_models_use_independent_database_connections(): void
    {
        $this->assertSame(
            self::SITE_CONNECTION,
            (new ConsultationRequest())->getConnection()->getName()
        );
        $this->assertSame(
            self::CRM_CONNECTION,
            (new CustomerPersonal())->getConnection()->getName()
        );

        $this->assertTrue(Schema::connection(self::SITE_CONNECTION)->hasTable('consultation_requests'));
        $this->assertFalse(Schema::connection(self::CRM_CONNECTION)->hasTable('consultation_requests'));
        $this->assertTrue(Schema::connection(self::CRM_CONNECTION)->hasTable('customer_personal'));
        $this->assertFalse(Schema::connection(self::SITE_CONNECTION)->hasTable('customer_personal'));
    }

    public function test_database_health_check_accepts_two_valid_connections(): void
    {
        $exitCode = Artisan::call('portal:check-databases');
        $output = Artisan::output();

        $this->assertSame(0, $exitCode);
        $this->assertStringContainsString('portal_testing', $output);
        $this->assertStringContainsString('crm_testing', $output);
    }

    public function test_database_health_check_rejects_the_same_connection_for_both_roles(): void
    {
        config(['customer_portal.connection' => self::SITE_CONNECTION]);

        $exitCode = Artisan::call('portal:check-databases');
        $output = Artisan::output();

        $this->assertSame(1, $exitCode);
        $this->assertStringContainsString('دو اتصال مجزا', $output);
    }

    public function test_database_health_check_rejects_two_names_pointing_to_the_same_database(): void
    {
        config([
            'database.connections.'.self::CRM_CONNECTION.'.database' => $this->siteDatabase,
        ]);
        DB::purge(self::CRM_CONNECTION);

        $exitCode = Artisan::call('portal:check-databases');
        $output = Artisan::output();

        $this->assertSame(1, $exitCode);
        $this->assertStringContainsString('هر دو اتصال به یک دیتابیس', $output);
    }

    public function test_activity_log_migration_does_not_require_a_tenants_table(): void
    {
        Schema::connection(self::SITE_CONNECTION)->drop('activity_log');
        $migration = require database_path('migrations/2026_07_17_000001_create_activity_log_table.php');

        $migration->up();
        // A second run represents recovery from the partially completed MySQL
        // migration that existed before the tenants foreign key was removed.
        $migration->up();

        $this->assertTrue(Schema::connection(self::SITE_CONNECTION)->hasTable('activity_log'));
        $this->assertTrue(Schema::connection(self::SITE_CONNECTION)->hasColumn('activity_log', 'tenant_id'));
        $this->assertFalse(Schema::connection(self::SITE_CONNECTION)->hasTable('tenants'));
    }

    /** @return array<string, mixed> */
    private function sqliteConnection(string $database): array
    {
        return [
            'driver' => 'sqlite',
            'database' => $database,
            'prefix' => '',
            'foreign_key_constraints' => false,
        ];
    }

    private function temporaryDatabase(string $prefix): string
    {
        $path = tempnam(sys_get_temp_dir(), $prefix);

        if ($path === false) {
            $this->fail('Could not create a temporary SQLite database.');
        }

        return $path;
    }

    private function createSiteSchema(): void
    {
        $schema = Schema::connection(self::SITE_CONNECTION);
        $schema->create('migrations', function (Blueprint $table): void {
            $table->id();
        });
        $schema->create('consultation_requests', function (Blueprint $table): void {
            $table->id();
        });
        $schema->create('activity_log', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->uuid('tenant_id');
        });
    }

    private function createCrmSchema(): void
    {
        $schema = Schema::connection(self::CRM_CONNECTION);
        $schema->create('customers', function (Blueprint $table): void {
            $table->string('id')->primary();
        });
        $schema->create('customer_personal', function (Blueprint $table): void {
            $table->string('id')->primary();
            $table->string('customer_id');
        });
    }
}
