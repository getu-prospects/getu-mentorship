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
        // First drop the index on status column
        Schema::table('mentors', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });

        // Then drop the existing status column with its constraint
        Schema::table('mentors', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        // Add it back with the correct enum values including 'rejected'
        Schema::table('mentors', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'suspended', 'rejected'])->default('pending')->after('join_online_community');
            $table->index('status');
        });

        // Drop the redundant expertise_areas JSON column - we use the pivot table instead
        Schema::table('mentors', function (Blueprint $table) {
            $table->dropColumn('expertise_areas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Re-add expertise_areas column
        Schema::table('mentors', function (Blueprint $table) {
            $table->json('expertise_areas')->nullable()->after('profession');
        });

        // Revert status column
        Schema::table('mentors', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropColumn('status');
        });

        Schema::table('mentors', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'suspended'])->default('pending')->after('join_online_community');
            $table->index('status');
        });
    }
};