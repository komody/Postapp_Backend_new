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
        // Schema::dropIfExists('follows');
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            // $table->primary(['following_user_id', 'followed_user_id']);
            // $table->foreign('following_user_id')->references('id')->on('users');
            $table->foreignId('following_user_id')->nullable()->constrained('users');
            // $table->foreign('followed_user_id')->references('id')->on('users');
            $table->foreignId('followed_user_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
