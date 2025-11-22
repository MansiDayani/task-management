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
        Schema::create('task_test_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attempt_id');
            $table->unsignedBigInteger('tester_id');
            $table->text('remarks')->nullable();
            $table->enum('status', ['pass', 'fail']);
            $table->timestamp('tested_at')->nullable();
            $table->timestamps();

            $table->foreign('attempt_id')->references('id')->on('task_attempts')->onDelete('cascade');
            $table->foreign('tester_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_test_reviews');
    }
};
