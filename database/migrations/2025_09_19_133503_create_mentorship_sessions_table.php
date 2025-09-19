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
        Schema::create('mentorship_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('mentorship_requests')->cascadeOnDelete();
            $table->foreignId('mentor_id')->constrained('mentors')->cascadeOnDelete();
            $table->timestamp('scheduled_at')->nullable();
            $table->enum('session_status', ['scheduled', 'completed', 'cancelled', 'no_show'])->default('scheduled');
            $table->text('session_notes')->nullable();
            $table->timestamps();

            $table->index('request_id');
            $table->index('mentor_id');
            $table->index('session_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentorship_sessions');
    }
};
