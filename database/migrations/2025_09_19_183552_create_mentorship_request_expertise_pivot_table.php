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
        Schema::dropIfExists('mentorship_request_expertise');
    }
};