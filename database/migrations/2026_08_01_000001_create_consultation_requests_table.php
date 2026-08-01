<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultation_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('company', 150);
            $table->string('mobile', 30);
            $table->string('email', 190)->nullable();
            $table->string('company_type', 100);
            $table->text('message')->nullable();
            $table->string('source_page', 2048)->nullable();
            $table->timestamps();

            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultation_requests');
    }
};
