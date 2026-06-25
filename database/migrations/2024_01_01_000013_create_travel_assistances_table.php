<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('travel_assistances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inquiry_id')->constrained()->cascadeOnDelete();
            $table->foreignId('patient_profile_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedBigInteger('assigned_to_user_id')->nullable();
            $table->boolean('visa_required')->default(false);
            $table->string('visa_country')->nullable();
            $table->string('visa_status')->default('not_started');
            $table->boolean('visa_invitation_sent')->default(false);
            $table->date('visa_approved_at')->nullable();
            $table->text('visa_notes')->nullable();
            $table->boolean('accommodation_required')->default(false);
            $table->string('accommodation_pref')->nullable();
            $table->string('accommodation_name')->nullable();
            $table->text('accommodation_address')->nullable();
            $table->date('accommodation_checkin')->nullable();
            $table->date('accommodation_checkout')->nullable();
            $table->integer('accommodation_cost_usd')->nullable();
            $table->string('accommodation_booking_ref')->nullable();
            $table->text('accommodation_notes')->nullable();
            $table->boolean('transfer_required')->default(false);
            $table->string('arrival_flight')->nullable();
            $table->timestamp('arrival_datetime')->nullable();
            $table->string('arrival_airport')->nullable();
            $table->string('departure_flight')->nullable();
            $table->timestamp('departure_datetime')->nullable();
            $table->text('transfer_notes')->nullable();
            $table->integer('transfer_cost_usd')->nullable();
            $table->boolean('interpreter_required')->default(false);
            $table->string('interpreter_language')->nullable();
            $table->text('interpreter_notes')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->foreign('assigned_to_user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('travel_assistances');
    }
};
