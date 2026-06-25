<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('treatment_plans', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->foreignId('inquiry_id')->constrained()->cascadeOnDelete();
            $table->foreignId('patient_profile_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('hospital_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('doctor_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedBigInteger('created_by_user_id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('total_duration_days')->nullable();
            $table->date('arrival_date')->nullable();
            $table->date('departure_date')->nullable();
            $table->string('arrival_flight')->nullable();
            $table->string('departure_flight')->nullable();
            $table->string('accommodation_name')->nullable();
            $table->text('accommodation_address')->nullable();
            $table->date('accommodation_checkin')->nullable();
            $table->date('accommodation_checkout')->nullable();
            $table->json('itinerary')->nullable();
            $table->text('pre_op_instructions')->nullable();
            $table->text('post_op_instructions')->nullable();
            $table->text('diet_restrictions')->nullable();
            $table->text('medication_plan')->nullable();
            $table->string('status')->default('draft');
            $table->timestamp('shared_at')->nullable();
            $table->timestamps();
            $table->foreign('created_by_user_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('treatment_plans');
    }
};
