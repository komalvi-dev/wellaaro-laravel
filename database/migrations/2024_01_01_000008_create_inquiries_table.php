<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('patient_profile_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedBigInteger('assigned_to_user_id')->nullable();
            $table->foreignId('specialty_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('treatment_id')->nullable()->constrained()->nullOnDelete();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_country_code')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('country_of_residence')->nullable();
            $table->string('nationality')->nullable();
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->text('condition_description')->nullable();
            $table->string('preferred_destination')->nullable();
            $table->string('preferred_timeline')->nullable();
            $table->string('budget_range')->nullable();
            $table->string('budget_currency')->default('USD');
            $table->text('current_medications')->nullable();
            $table->text('previous_treatments')->nullable();
            $table->text('additional_notes')->nullable();
            $table->integer('companions_count')->default(0);
            $table->string('accommodation_pref')->nullable();
            $table->boolean('needs_visa_assistance')->default(false);
            $table->boolean('needs_airport_transfer')->default(false);
            $table->boolean('needs_interpreter')->default(false);
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('utm_term')->nullable();
            $table->string('utm_content')->nullable();
            $table->string('referrer_url')->nullable();
            $table->string('landing_page')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('source_page')->nullable();
            $table->string('status')->default('new');
            $table->string('priority')->default('normal');
            $table->boolean('whatsapp_opt_in')->default(false);
            $table->boolean('email_opt_in')->default(true);
            $table->boolean('is_spam')->default(false);
            $table->string('spam_reason')->nullable();
            $table->timestamps();
            $table->foreign('assigned_to_user_id')->references('id')->on('users')->nullOnDelete();
            $table->index('status');
            $table->index('email');
        });

        Schema::create('inquiry_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inquiry_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('content');
            $table->string('note_type')->default('general');
            $table->boolean('is_internal')->default(true);
            $table->timestamps();
        });

        Schema::create('inquiry_status_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inquiry_id')->constrained()->cascadeOnDelete();
            $table->string('from_status')->nullable();
            $table->string('to_status');
            $table->unsignedBigInteger('changed_by_user_id')->nullable();
            $table->text('reason')->nullable();
            $table->timestamps();
            $table->foreign('changed_by_user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inquiry_status_histories');
        Schema::dropIfExists('inquiry_notes');
        Schema::dropIfExists('inquiries');
    }
};
