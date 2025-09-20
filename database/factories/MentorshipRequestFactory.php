<?php

namespace Database\Factories;

use App\Enums\MentorshipRequestStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MentorshipRequest>
 */
class MentorshipRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mentee_name' => fake()->name(),
            'mentee_email' => fake()->unique()->safeEmail(),
            'mentee_phone' => fake()->optional(0.7)->phoneNumber(),
            'help_description' => fake()->paragraph(3),
            'status' => fake()->randomElement(MentorshipRequestStatus::cases()),
            'matched_mentor_id' => null,
            'matched_at' => null,
            'matched_by' => null,
        ];
    }

    /**
     * Indicate that the mentorship request is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => MentorshipRequestStatus::Pending,
            'matched_mentor_id' => null,
            'matched_at' => null,
            'matched_by' => null,
        ]);
    }

    /**
     * Indicate that the mentorship request is matched.
     */
    public function matched(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => MentorshipRequestStatus::Matched,
            'matched_at' => fake()->dateTimeBetween('-1 month', 'now'),
            'matched_by' => 1,
        ]);
    }

    /**
     * Indicate that the mentorship request is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => MentorshipRequestStatus::Completed,
            'matched_at' => fake()->dateTimeBetween('-3 months', '-1 month'),
            'matched_by' => 1,
        ]);
    }

    /**
     * Indicate that the mentorship request is cancelled.
     */
    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => MentorshipRequestStatus::Cancelled,
            'matched_mentor_id' => null,
            'matched_at' => null,
            'matched_by' => null,
        ]);
    }
}
