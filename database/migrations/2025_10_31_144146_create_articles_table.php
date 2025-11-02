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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->json('content')->nullable();
            $table->string('title')->unique();
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->string('author_name')->nullable();
            $table->string('author_url')->nullable();
            $table->string('language', 5)->default('en');
            $table->timestamp('published_at')->nullable();
            $table->enum('status', ['draft', 'scheduled', 'published', 'failed'])->default('draft');
            $table->string('telegraph_url')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('reactions_count')->default(0);
            $table->timestamp('last_synced_at')->nullable();
            $table->foreignId('channel_id')->constrained('channels')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
