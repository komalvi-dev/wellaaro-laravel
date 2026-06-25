<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->foreignId('inquiry_id')->constrained()->cascadeOnDelete();
            $table->foreignId('hospital_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('doctor_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('treatment_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedBigInteger('created_by_user_id');
            $table->string('currency')->default('USD');
            $table->integer('treatment_cost')->default(0);
            $table->integer('hospital_stay_cost')->default(0);
            $table->integer('consultation_cost')->default(0);
            $table->integer('diagnostic_cost')->default(0);
            $table->integer('medicine_cost')->default(0);
            $table->integer('travel_cost')->default(0);
            $table->integer('accommodation_cost')->default(0);
            $table->integer('visa_cost')->default(0);
            $table->integer('other_cost')->default(0);
            $table->integer('discount_amount')->default(0);
            $table->integer('total_cost')->default(0);
            $table->integer('deposit_amount')->default(0);
            $table->integer('deposit_percentage')->default(20);
            $table->text('inclusions')->nullable();
            $table->text('exclusions')->nullable();
            $table->integer('validity_days')->default(30);
            $table->date('valid_until')->nullable();
            $table->text('notes')->nullable();
            $table->text('terms')->nullable();
            $table->text('hospital_details')->nullable();
            $table->text('doctor_details')->nullable();
            $table->string('treatment_duration')->nullable();
            $table->integer('hospital_stay_days')->nullable();
            $table->string('status')->default('draft');
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('viewed_at')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->string('patient_response')->nullable();
            $table->text('patient_response_note')->nullable();
            $table->integer('version')->default(1);
            $table->unsignedBigInteger('parent_quotation_id')->nullable();
            $table->timestamps();
            $table->foreign('created_by_user_id')->references('id')->on('users');
            $table->foreign('parent_quotation_id')->references('id')->on('quotations')->nullOnDelete();
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
