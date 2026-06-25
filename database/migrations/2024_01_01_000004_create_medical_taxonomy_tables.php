<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('specialties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('icon_class')->nullable();
            $table->text('icon_svg')->nullable();
            $table->string('featured_image_url')->nullable();
            $table->boolean('published')->default(true);
            $table->boolean('featured')->default(false);
            $table->integer('position')->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
            $table->index('featured');
        });

        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('specialty_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('procedure_details')->nullable();
            $table->string('recovery_time')->nullable();
            $table->string('hospital_stay')->nullable();
            $table->string('success_rate')->nullable();
            $table->integer('cost_india_min')->nullable();
            $table->integer('cost_india_max')->nullable();
            $table->integer('cost_usa')->nullable();
            $table->integer('cost_uk')->nullable();
            $table->integer('cost_savings_percent')->nullable();
            $table->string('featured_image_url')->nullable();
            $table->boolean('published')->default(true);
            $table->boolean('featured')->default(false);
            $table->integer('position')->default(0);
            $table->json('faq_schema')->nullable();
            $table->json('schema_markup')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
            $table->index('specialty_id');
            $table->index('parent_id');
            $table->index('featured');
            $table->foreign('parent_id')->references('id')->on('treatments')->nullOnDelete();
        });

        Schema::create('conditions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icd10_code')->nullable();
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('symptoms')->nullable();
            $table->text('causes')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('treatment_overview')->nullable();
            $table->boolean('published')->default(true);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
        });

        Schema::create('condition_treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('condition_id')->constrained()->cascadeOnDelete();
            $table->foreignId('treatment_id')->constrained()->cascadeOnDelete();
            $table->unique(['condition_id', 'treatment_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('condition_treatments');
        Schema::dropIfExists('conditions');
        Schema::dropIfExists('treatments');
        Schema::dropIfExists('specialties');
    }
};
