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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
