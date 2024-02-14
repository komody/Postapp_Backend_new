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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->comment('1: 返信, 2: いいね, 3: フォロー');
            // $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('user_id')->nullable()->constrained();
            // $table->foreign('notified_by')->references('id')->on('users');
            $table->foreignId('notified_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
