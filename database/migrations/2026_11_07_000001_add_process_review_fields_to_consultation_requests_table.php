<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('consultation_requests', function (Blueprint $table): void {
            $table->string('company_type', 100)->nullable()->change();
            $table->string('topic', 60)->nullable()->after('primary_need');
            $table->string('topic_label', 150)->nullable()->after('topic');
            $table->json('answers')->nullable()->after('topic_label');
            $table->json('utm_parameters')->nullable()->after('source_page');

            $table->index('topic');
        });
    }

    public function down(): void
    {
        DB::table('consultation_requests')
            ->whereNull('company_type')
            ->update(['company_type' => 'شرکت حمل‌ونقل بین‌المللی']);

        Schema::table('consultation_requests', function (Blueprint $table): void {
            $table->dropIndex(['topic']);
            $table->dropColumn(['topic', 'topic_label', 'answers', 'utm_parameters']);
            $table->string('company_type', 100)->nullable(false)->change();
        });
    }
};
