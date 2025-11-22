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
        // Check if column doesn't exist before adding
        if (!Schema::hasColumn('task_attempts', 'file_path')) {
            Schema::table('task_attempts', function (Blueprint $table) {
                $table->string('file_path')->nullable()->after('submission_notes');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('task_attempts', function (Blueprint $table) {
            if (Schema::hasColumn('task_attempts', 'file_path')) {
                $table->dropColumn('file_path');
            }
        });
    }
};

