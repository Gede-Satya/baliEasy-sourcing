<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->text('website_url')->nullable()->change();
            $table->text('maps_url')->nullable()->change();
            $table->text('instagram_url')->nullable()->change();
            $table->text('cover_image')->nullable()->change();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->text('cover_image')->nullable()->change();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->text('cover_image')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->string('website_url')->nullable()->change();
            $table->string('maps_url')->nullable()->change();
            $table->string('instagram_url')->nullable()->change();
            $table->string('cover_image')->nullable()->change();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('cover_image')->nullable()->change();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('cover_image')->nullable()->change();
        });
    }
};
