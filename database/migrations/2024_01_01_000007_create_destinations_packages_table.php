<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('tagline')->nullable();
            $table->text('description')->nullable();
            $table->text('why_choose')->nullable();
            $table->text('cost_savings_text')->nullable();
            $table->text('visa_info')->nullable();
            $table->string('best_time_to_visit')->nullable();
            $table->string('climate')->nullable();
            $table->string('featured_image_url')->nullable();
            $table->boolean('published')->default(false);
            $table->integer('position')->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
            $table->index('published');
        });

        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('tagline')->nullable();
            $table->text('description')->nullable();
            $table->json('highlights')->nullable();
            $table->integer('duration_days_min')->nullable();
            $table->integer('duration_days_max')->nullable();
            $table->integer('price_usd_from')->nullable();
            $table->string('price_note')->nullable();
            $table->foreignId('destination_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('specialty_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('hospital_id')->nullable()->constrained()->nullOnDelete();
            $table->string('package_type')->default('treatment');
            $table->json('inclusions')->nullable();
            $table->json('exclusions')->nullable();
            $table->json('itinerary')->nullable();
            $table->string('featured_image_url')->nullable();
            $table->boolean('published')->default(false);
            $table->boolean('featured')->default(false);
            $table->integer('position')->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
            $table->index('featured');
        });

        Schema::create('package_treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained()->cascadeOnDelete();
            $table->foreignId('treatment_id')->constrained()->cascadeOnDelete();
            $table->unique(['package_id', 'treatment_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('package_treatments');
        Schema::dropIfExists('packages');
        Schema::dropIfExists('destinations');
    }
};
