<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_category_id')->constrains('blog_categories', 'id');
            $table->unsignedBigInteger('blog_tag_id')->constrains('blog_tags', 'id');
            $table->json('title');
            $table->string('slug')->unique();
            $table->tinyInteger('status')->nullable();
            $table->string('priority')->nullable();
            $table->json('short_description');
            $table->json('long_description');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
