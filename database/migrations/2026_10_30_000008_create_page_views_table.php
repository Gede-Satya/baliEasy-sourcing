<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->string('session_id', 80)->nullable()->index();
            $table->string('ip_hash', 64)->index();
            $table->string('path', 255)->index();
            $table->text('url')->nullable();
            $table->string('page_title', 255)->nullable();
            $table->string('referer', 500)->nullable();
            $table->string('device', 40)->default('Desktop')->index();
            $table->string('browser', 60)->nullable();
            $table->string('platform', 60)->nullable();
            $table->string('locale', 10)->default('en');
            $table->timestamp('created_at')->useCurrent()->index();

            $table->index(['created_at', 'path']);
            $table->index(['created_at', 'ip_hash']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_views');
    }
};
