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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no')->unique(); // e.g. RFQ-2026-0001
            $table->string('name');
            $table->string('company')->nullable();
            $table->string('email');
            $table->string('whatsapp')->nullable();
            $table->string('country')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->text('description')->nullable();
            $table->string('quantity')->nullable();
            $table->date('target_date')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['new', 'contacted', 'quoted', 'closed', 'lost'])->default('new');
            $table->text('internal_notes')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
        });

        Schema::create('quotation_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->constrained('quotations')->cascadeOnDelete();
            $table->string('path');
            $table->string('original_name');
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('size')->nullable(); // size in bytes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_attachments');
        Schema::dropIfExists('quotations');
    }
};

