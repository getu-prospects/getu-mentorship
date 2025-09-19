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
        Schema::table('mentors', function (Blueprint $table) {
            $table->string('location')->nullable()->after('phone');
            $table->string('profession')->nullable()->after('location');
            $table->text('additional_contribution')->nullable()->after('bio');
            $table->boolean('join_online_community')->default(false)->after('additional_contribution');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mentors', function (Blueprint $table) {
            $table->dropColumn([
                'location',
                'profession',
                'additional_contribution',
                'join_online_community',
            ]);
        });
    }
};
