<?php

namespace Database\Seeders;

use App\Models\ExpertiseCategory;
use App\Models\Mentor;
use Illuminate\Database\Seeder;

class MentorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have expertise categories
        $this->call(ExpertiseCategorySeeder::class);

        // Get all expertise category IDs for relationship attachment
        $expertiseCategories = ExpertiseCategory::where('is_active', true)->get();

        // Create 6 approved mentors
        Mentor::factory()
            ->count(6)
            ->approved()
            ->create()
            ->each(function ($mentor) use ($expertiseCategories) {
                // Attach random expertise categories to the pivot table
                $randomCategories = $expertiseCategories->random(rand(1, 3));
                $mentor->expertiseCategories()->attach($randomCategories->pluck('id'));
            });

        // Create 2 pending mentors
        Mentor::factory()
            ->count(2)
            ->pending()
            ->create()
            ->each(function ($mentor) use ($expertiseCategories) {
                $randomCategories = $expertiseCategories->random(rand(1, 2));
                $mentor->expertiseCategories()->attach($randomCategories->pluck('id'));
            });

        // Create 1 suspended mentor
        Mentor::factory()
            ->count(1)
            ->suspended()
            ->create()
            ->each(function ($mentor) use ($expertiseCategories) {
                $randomCategories = $expertiseCategories->random(rand(1, 2));
                $mentor->expertiseCategories()->attach($randomCategories->pluck('id'));
            });

        // Create 1 rejected mentor
        Mentor::factory()
            ->count(1)
            ->rejected()
            ->create()
            ->each(function ($mentor) use ($expertiseCategories) {
                $randomCategories = $expertiseCategories->random(rand(1, 2));
                $mentor->expertiseCategories()->attach($randomCategories->pluck('id'));
            });

        $this->command->info('Seeded 10 test mentors using factory.');
        $this->command->info('Approved: 6, Pending: 2, Suspended: 1, Rejected: 1');
    }
}