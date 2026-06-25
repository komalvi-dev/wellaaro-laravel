<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('tagline')->nullable();
            $table->text('description')->nullable();
            $table->text('about')->nullable();
            $table->integer('established_year')->nullable();
            $table->integer('bed_count')->nullable();
            $table->integer('ot_count')->nullable();
            $table->integer('annual_patients')->nullable();
            $table->foreignId('country_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained()->nullOnDelete();
            $table->text('address')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('featured_image_url')->nullable();
            $table->string('tier')->default('standard');
            $table->boolean('is_partner')->default(true);
            $table->boolean('is_jci_accredited')->default(false);
            $table->boolean('is_nabh_accredited')->default(false);
            $table->json('accreditations')->nullable();
            $table->json('awards')->nullable();
            $table->boolean('international_patient_desk')->default(false);
            $table->json('languages_spoken')->nullable();
            $table->boolean('published')->default(false);
            $table->boolean('featured')->default(false);
            $table->integer('position')->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->json('schema_markup')->nullable();
            $table->timestamps();
            $table->index('featured');
            $table->index('published');
            $table->index('tier');
        });

        Schema::create('hospital_specialties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hospital_id')->constrained()->cascadeOnDelete();
            $table->foreignId('specialty_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_center_of_excellence')->default(false);
            $table->text('description')->nullable();
            $table->unique(['hospital_id', 'specialty_id']);
        });

        Schema::create('hospital_facilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hospital_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('icon_class')->nullable();
            $table->string('category')->nullable();
            $table->timestamps();
        });

        Schema::create('hospital_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hospital_id')->constrained()->cascadeOnDelete();
            $table->string('image_url');
            $table->string('caption')->nullable();
            $table->integer('position')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hospital_galleries');
        Schema::dropIfExists('hospital_facilities');
        Schema::dropIfExists('hospital_specialties');
        Schema::dropIfExists('hospitals');
    }
};
