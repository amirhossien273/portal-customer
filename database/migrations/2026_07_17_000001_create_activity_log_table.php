<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tableName = config('activitylog.table_name', 'activity_log');

        // MySQL creates the table before applying foreign keys. A previous
        // deployment may therefore have a complete, empty activity_log table
        // left behind after the obsolete tenants foreign key failed.
        if (Schema::hasTable($tableName)) {
            return;
        }

        Schema::create($tableName, function (Blueprint $table): void {
            $table->uuid('id')->primary();
            // portal-customer has its own database and intentionally does not
            // own the CRM tenants table, so this value is indexed but has no FK.
            $table->uuid('tenant_id')
                ->default((string) config('customer_portal.tenant_id'));
            $table->string('log_name')->nullable();
            $table->text('description');
            $table->nullableUuidMorphs('subject', 'subject');
            $table->string('event')->nullable();
            $table->nullableUuidMorphs('causer', 'causer');
            $table->json('properties')->nullable();
            $table->uuid('batch_uuid')->nullable();
            $table->timestamps();

            $table->index(['tenant_id', 'created_at']);
            $table->index(['tenant_id', 'event']);
            $table->index('log_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('activitylog.table_name', 'activity_log'));
    }
};
