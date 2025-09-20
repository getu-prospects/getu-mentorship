<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MentorshipSession>
 */
class MentorshipSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'request_id' => \App\Models\MentorshipRequest::factory(),
            'mentor_id' => \App\Models\Mentor::factory(),
            'scheduled_at' => fake()->dateTimeBetween('+1 day', '+1 week'),
            'session_status' => \App\Enums\MentorshipSessionStatus::Scheduled,
            'session_notes' => fake()->optional(0.3)->sentence(10),
        ];
    }
}
