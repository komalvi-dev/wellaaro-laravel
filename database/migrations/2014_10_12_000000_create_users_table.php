<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('patient');
            $table->string('status')->default('active');
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('confirmation_token')->nullable()->unique();
            $table->timestamp('confirmation_sent_at')->nullable();
            $table->string('unconfirmed_email')->nullable();
            $table->integer('sign_in_count')->default(0);
            $table->timestamp('current_sign_in_at')->nullable();
            $table->timestamp('last_sign_in_at')->nullable();
            $table->string('current_sign_in_ip')->nullable();
            $table->string('last_sign_in_ip')->nullable();
            $table->integer('failed_attempts')->default(0);
            $table->string('unlock_token')->nullable()->unique();
            $table->timestamp('locked_at')->nullable();
            $table->timestamps();
            $table->index('role');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
