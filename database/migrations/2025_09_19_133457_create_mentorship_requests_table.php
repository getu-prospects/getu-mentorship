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
        Schema::create('mentorship_requests', function (Blueprint $table) {
            $table->id();
            $table->string('mentee_name');
            $table->string('mentee_email');
            $table->string('mentee_phone')->nullable();
            $table->text('help_description');
            $table->json('preferred_expertise')->nullable();
            $table->enum('status', ['pending', 'matched', 'completed', 'cancelled'])->default('pending');
            $table->foreignId('matched_mentor_id')->nullable()->constrained('mentors')->nullOnDelete();
            $table->timestamp('matched_at')->nullable();
            $table->foreignId('matched_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('mentee_email');
            $table->index('status');
            $table->index('matched_mentor_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentorship_requests');
    }
};
