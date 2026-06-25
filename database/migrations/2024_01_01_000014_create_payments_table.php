<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->foreignId('inquiry_id')->constrained()->cascadeOnDelete();
            $table->foreignId('quotation_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('patient_profile_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedBigInteger('created_by_user_id')->nullable();
            $table->integer('amount');
            $table->string('currency')->default('USD');
            $table->string('payment_type');
            $table->string('payment_method')->nullable();
            $table->string('gateway_name')->nullable();
            $table->string('gateway_transaction_id')->nullable();
            $table->json('gateway_response')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('transfer_reference')->nullable();
            $table->string('status')->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->text('description')->nullable();
            $table->string('receipt_url')->nullable();
            $table->string('invoice_number')->nullable();
            $table->timestamps();
            $table->foreign('created_by_user_id')->references('id')->on('users')->nullOnDelete();
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
