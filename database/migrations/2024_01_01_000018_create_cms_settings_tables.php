<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cms_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('template')->default('default');
            $table->text('body')->nullable();
            $table->json('sections')->nullable();
            $table->boolean('published')->default(false);
            $table->boolean('show_in_sitemap')->default(true);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('og_image_url')->nullable();
            $table->timestamps();
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->text('answer');
            $table->string('category')->nullable();
            $table->foreignId('specialty_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('treatment_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('position')->default(0);
            $table->boolean('published')->default(true);
            $table->timestamps();
            $table->index('category');
        });

        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('value_type')->default('string');
            $table->string('group')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('updated_by_user_id')->nullable();
            $table->timestamps();
            $table->foreign('updated_by_user_id')->references('id')->on('users')->nullOnDelete();
            $table->index('group');
        });

        Schema::create('seo_redirects', function (Blueprint $table) {
            $table->id();
            $table->string('from_path')->unique();
            $table->string('to_path');
            $table->integer('redirect_type')->default(301);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('newsletter_subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('first_name')->nullable();
            $table->string('country')->nullable();
            $table->string('source')->nullable();
            $table->json('interests')->nullable();
            $table->boolean('is_confirmed')->default(false);
            $table->string('confirmation_token')->nullable();
            $table->timestamp('subscribed_at')->nullable();
            $table->timestamp('unsubscribed_at')->nullable();
            $table->string('unsubscribe_reason')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('newsletter_subscribers');
        Schema::dropIfExists('seo_redirects');
        Schema::dropIfExists('site_settings');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('cms_pages');
    }
};
