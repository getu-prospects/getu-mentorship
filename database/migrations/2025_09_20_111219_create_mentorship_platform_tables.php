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
        // 1. Expertise Categories
        Schema::create('expertise_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_de')->nullable();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index('slug');
            $table->index('is_active');
        });

        // 2. Mentors (with all final fields consolidated)
        Schema::create('mentors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('profession')->nullable();
            $table->string('booking_calendar_link');
            $table->text('additional_contribution')->nullable();
            $table->boolean('join_online_community')->default(false);
            $table->enum('status', ['pending', 'approved', 'suspended', 'rejected'])->default('pending');
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('email');
            $table->index('status');
        });

        // 3. Mentorship Requests
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
            $table->text('assignment_notes')->nullable();
            $table->timestamps();

            $table->index('mentee_email');
            $table->index('status');
            $table->index('matched_mentor_id');
        });

        // 4. Mentorship Sessions
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

        // 5. Feedback
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('mentorship_sessions')->cascadeOnDelete();
            $table->enum('feedback_type', ['mentor', 'mentee']);
            $table->integer('rating')->nullable()->unsigned()->comment('1-5 rating');
            $table->text('comments')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();

            $table->index('session_id');
            $table->index('feedback_type');
            $table->index(['session_id', 'feedback_type']);
        });

        // 6. Feedback Tokens
        Schema::create('feedback_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique();
            $table->foreignId('session_id')->constrained('mentorship_sessions')->onDelete('cascade');
            $table->enum('type', ['mentee_feedback', 'mentor_report']);
            $table->boolean('used')->default(false);
            $table->timestamp('expires_at');
            $table->timestamp('used_at')->nullable();
            $table->timestamps();

            $table->index(['token', 'used']);
            $table->index(['session_id', 'type']);
        });

        // 7. Mentor Expertise Pivot Table
        Schema::create('mentor_expertise', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')->constrained()->onDelete('cascade');
            $table->foreignId('expertise_category_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['mentor_id', 'expertise_category_id']);
        });

        // 8. Mentorship Request Expertise Pivot Table
        Schema::create('mentorship_request_expertise', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentorship_request_id')
                ->constrained('mentorship_requests')
                ->cascadeOnDelete();
            $table->foreignId('expertise_category_id')
                ->constrained('expertise_categories')
                ->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['mentorship_request_id', 'expertise_category_id'], 'unique_request_expertise');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop in reverse order to handle foreign key constraints
        Schema::dropIfExists('mentorship_request_expertise');
        Schema::dropIfExists('mentor_expertise');
        Schema::dropIfExists('feedback_tokens');
        Schema::dropIfExists('feedback');
        Schema::dropIfExists('mentorship_sessions');
        Schema::dropIfExists('mentorship_requests');
        Schema::dropIfExists('mentors');
        Schema::dropIfExists('expertise_categories');
    }
};
