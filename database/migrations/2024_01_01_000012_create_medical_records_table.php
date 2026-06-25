<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_profile_id')->constrained()->cascadeOnDelete();
            $table->foreignId('inquiry_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedBigInteger('uploaded_by_user_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('record_type');
            $table->string('file_name')->nullable();
            $table->integer('file_size')->nullable();
            $table->string('content_type')->nullable();
            $table->string('file_url')->nullable();
            $table->date('record_date')->nullable();
            $table->string('issuing_doctor')->nullable();
            $table->string('issuing_hospital')->nullable();
            $table->boolean('is_pre_treatment')->default(true);
            $table->boolean('is_sensitive')->default(false);
            $table->string('access_level')->default('patient_and_staff');
            $table->timestamps();
            $table->foreign('uploaded_by_user_id')->references('id')->on('users');
            $table->index('patient_profile_id');
        });

        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->morphs('documentable');
            $table->unsignedBigInteger('uploaded_by_user_id');
            $table->string('title');
            $table->string('document_type');
            $table->string('file_name')->nullable();
            $table->integer('file_size')->nullable();
            $table->string('content_type')->nullable();
            $table->string('file_url')->nullable();
            $table->boolean('is_visible_to_patient')->default(true);
            $table->timestamps();
            $table->foreign('uploaded_by_user_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
        Schema::dropIfExists('medical_records');
    }
};
