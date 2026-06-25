<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_profile_id')->constrained()->cascadeOnDelete();
            $table->morphs('reviewable');
            $table->foreignId('treatment_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('inquiry_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('overall_rating');
            $table->integer('doctor_rating')->nullable();
            $table->integer('hospital_rating')->nullable();
            $table->integer('value_rating')->nullable();
            $table->integer('communication_rating')->nullable();
            $table->string('title')->nullable();
            $table->text('body');
            $table->text('pros')->nullable();
            $table->text('cons')->nullable();
            $table->string('country_of_origin')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_video')->default(false);
            $table->string('video_url')->nullable();
            $table->string('video_thumbnail_url')->nullable();
            $table->boolean('published')->default(false);
            $table->string('rejection_reason')->nullable();
            $table->timestamps();
            $table->index('published');
        });

        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->string('country')->nullable();
            $table->string('treatment')->nullable();
            $table->foreignId('hospital_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('doctor_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('specialty_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('rating')->default(5);
            $table->string('short_quote');
            $table->text('full_story')->nullable();
            $table->string('photo_url')->nullable();
            $table->string('video_url')->nullable();
            $table->string('video_thumbnail_url')->nullable();
            $table->integer('video_duration')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_video')->default(false);
            $table->integer('position')->default(0);
            $table->boolean('published')->default(false);
            $table->timestamps();
            $table->index('is_featured');
            $table->index('published');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('reviews');
    }
};
