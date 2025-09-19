<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ExpertiseCategorySeeder::class,
            MentorSeeder::class,
        ]);

        User::firstOrCreate(
            ['email' => 'admin@getu-mentorship.org'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
            ]
        );
    }
}
