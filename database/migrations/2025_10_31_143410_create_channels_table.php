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
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('telegram_id')->unique();
            $table->string('username')->nullable()->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('invite_link')->nullable();

            $table->bigInteger('discussion_group_id')->unique()->nullable();
            $table->string('discussion_group_link')->unique()->nullable();
            $table->boolean('comments_enabled')->default(false);

            $table->boolean('anti_spam_enabled')->default(true);
            $table->boolean('ban_on_link_username')->default(true);
            $table->json('banned_usernames')->nullable();
            $table->json('banned_links')->nullable();

            $table->unsignedBigInteger('members_count')->default(0);
            $table->unsignedBigInteger('views_total')->default(0);
            $table->timestamp('last_synced_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('channels');
    }
};
