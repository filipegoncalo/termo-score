<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daily_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->unsignedSmallInteger('game_id');
            $table->string('score');
            $table->string('detail');
            $table->string('word', 5)->nullable();
            $table->string('status', 10)->nullable();
            $table->smallInteger('points')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_scores');
    }
};
