<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('iso_code', 2)->unique();
            $table->string('iso3_code', 3)->nullable();
            $table->string('phone_code')->nullable();
            $table->string('currency_code', 3)->nullable();
            $table->string('flag_emoji')->nullable();
            $table->boolean('is_destination')->default(false);
            $table->boolean('is_source')->default(true);
            $table->integer('position')->default(0);
            $table->timestamps();
            $table->index('is_destination');
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->boolean('is_medical_hub')->default(false);
            $table->text('description')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
            $table->index('country_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cities');
        Schema::dropIfExists('countries');
    }
};
