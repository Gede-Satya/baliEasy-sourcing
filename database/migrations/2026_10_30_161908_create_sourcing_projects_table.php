<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sourcing_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->nullable()->constrained('quotations')->nullOnDelete();
            $table->string('project_code', 50)->unique(); // e.g. PRJ-2026-0001
            $table->string('access_token', 64)->unique(); // secret url token e.g. trk_9a8b7c6d5e4f
            $table->string('title'); // e.g. "Solid Teak Dining Sets & Basins for Villa Canggu"
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();

            // Client Info
            $table->string('client_name');
            $table->string('client_company')->nullable();
            $table->string('client_email');
            $table->string('client_whatsapp')->nullable();
            $table->string('client_country')->nullable();

            // Workshop Info
            $table->string('workshop_name')->nullable();
            $table->string('workshop_location')->nullable();

            // Project Milestones & Progress
            $table->string('stage', 40)->default('sampling'); 
            // stages: sampling, production, quality_control, packing_stuffing, shipping, delivered, on_hold
            $table->unsignedTinyInteger('progress_percent')->default(15); // 0 - 100
            
            $table->date('target_completion_date')->nullable();
            $table->date('estimated_shipping_date')->nullable();
            $table->timestamp('qc_passed_at')->nullable();
            $table->text('qc_notes')->nullable();
            $table->text('internal_notes')->nullable();
            $table->text('client_notes')->nullable();

            // Media & Timeline
            $table->json('photos')->nullable(); // array of uploaded photo paths
            $table->json('timeline_updates')->nullable(); // list of update logs

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sourcing_projects');
    }
};
