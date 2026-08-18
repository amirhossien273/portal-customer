<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('consultation_requests', function (Blueprint $table): void {
            $table->string('approximate_users', 30)->nullable();
            $table->string('primary_need', 100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('consultation_requests', function (Blueprint $table): void {
            $table->dropColumn(['approximate_users', 'primary_need']);
        });
    }
};
