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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('developer_id')->nullable();
            $table->unsignedBigInteger('tester_id')->nullable();
            $table->unsignedBigInteger('pm_id')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('deadline');

        $table->enum('status', [
            'pending',
            'submitted',
            'testing',
            'failed',
            'completed',
            'pm_review',
            'final_completed'
        ])->default('pending');

        $table->integer('failed_attempts')->default(0);
            $table->timestamps();

            // Foreign Keys
        $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        $table->foreign('developer_id')->references('id')->on('users')->onDelete('set null');
        $table->foreign('tester_id')->references('id')->on('users')->onDelete('set null');
        $table->foreign('pm_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};