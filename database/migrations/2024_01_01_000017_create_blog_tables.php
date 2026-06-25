<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('position')->default(0);
            $table->boolean('published')->default(true);
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('blog_categories')->nullOnDelete();
        });

        Schema::create('blog_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('excerpt')->nullable();
            $table->text('body');
            $table->unsignedBigInteger('author_user_id')->nullable();
            $table->string('author_name')->nullable();
            $table->foreignId('blog_category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('featured_image_url')->nullable();
            $table->string('featured_image_alt')->nullable();
            $table->integer('read_time_minutes')->nullable();
            $table->integer('views_count')->default(0);
            $table->boolean('published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->foreignId('specialty_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('treatment_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('hospital_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('destination_id')->nullable()->constrained()->nullOnDelete();
            $table->string('schema_type')->default('Article');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('og_image_url')->nullable();
            $table->timestamps();
            $table->foreign('author_user_id')->references('id')->on('users')->nullOnDelete();
            $table->index('published');
            $table->index('published_at');
        });

        Schema::create('blog_post_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('blog_tag_id')->constrained()->cascadeOnDelete();
            $table->unique(['blog_post_id', 'blog_tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_post_tags');
        Schema::dropIfExists('blog_posts');
        Schema::dropIfExists('blog_tags');
        Schema::dropIfExists('blog_categories');
    }
};
