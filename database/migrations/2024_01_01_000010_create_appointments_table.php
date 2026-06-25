<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->foreignId('inquiry_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('patient_profile_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('doctor_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('hospital_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('treatment_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedBigInteger('created_by_user_id')->nullable();
            $table->string('appointment_type');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->string('timezone')->default('UTC');
            $table->integer('duration_minutes')->default(30);
            $table->string('meeting_link')->nullable();
            $table->text('meeting_notes')->nullable();
            $table->string('status')->default('scheduled');
            $table->boolean('reminder_sent_24h')->default(false);
            $table->boolean('reminder_sent_1h')->default(false);
            $table->text('cancellation_reason')->nullable();
            $table->unsignedBigInteger('cancelled_by_user_id')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->text('notes')->nullable();
            $table->text('post_consultation_notes')->nullable();
            $table->timestamps();
            $table->foreign('created_by_user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('cancelled_by_user_id')->references('id')->on('users')->nullOnDelete();
            $table->index('appointment_date');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
