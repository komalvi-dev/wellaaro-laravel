<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('hospital_id')->nullable()->constrained()->nullOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('slug')->unique();
            $table->string('title')->default('Dr.');
            $table->string('designation')->nullable();
            $table->string('qualifications')->nullable();
            $table->integer('experience_years')->nullable();
            $table->text('about')->nullable();
            $table->text('training')->nullable();
            $table->text('achievements')->nullable();
            $table->json('languages_spoken')->nullable();
            $table->integer('consultation_fee_usd')->nullable();
            $table->boolean('online_consultation')->default(false);
            $table->boolean('in_person_consultation')->default(true);
            $table->integer('response_time_hours')->default(48);
            $table->string('photo_url')->nullable();
            $table->boolean('published')->default(false);
            $table->boolean('featured')->default(false);
            $table->integer('position')->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->json('schema_markup')->nullable();
            $table->timestamps();
            $table->index('featured');
            $table->index('published');
        });

        Schema::create('doctor_specialties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('specialty_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_primary')->default(false);
            $table->unique(['doctor_id', 'specialty_id']);
        });

        Schema::create('doctor_treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('treatment_id')->constrained()->cascadeOnDelete();
            $table->unique(['doctor_id', 'treatment_id']);
        });

        Schema::create('doctor_hospitals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('hospital_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_primary')->default(false);
            $table->json('visiting_days')->nullable();
            $table->unique(['doctor_id', 'hospital_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctor_hospitals');
        Schema::dropIfExists('doctor_treatments');
        Schema::dropIfExists('doctor_specialties');
        Schema::dropIfExists('doctors');
    }
};
