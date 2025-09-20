<?php

namespace Database\Factories;

use App\Enums\MentorStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mentor>
 */
class MentorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->optional(0.8)->phoneNumber(),
            'location' => fake()->randomElement(['Berlin', 'Hamburg', 'München', 'Köln', 'Frankfurt', 'Stuttgart', 'Düsseldorf', 'Dortmund', 'Leipzig']),
            'profession' => fake()->jobTitle(),
            'booking_calendar_link' => 'https://calendly.com/'.fake()->slug(),
            'additional_contribution' => fake()->optional(0.7)->sentence(15),
            'join_online_community' => fake()->boolean(70),
            'status' => fake()->randomElement(MentorStatus::cases()),
            'approved_at' => function (array $attributes) {
                return in_array($attributes['status'], [MentorStatus::Approved, MentorStatus::Suspended])
                    ? fake()->dateTimeBetween('-3 months', 'now')
                    : null;
            },
            'approved_by' => function (array $attributes) {
                return $attributes['approved_at'] ? \App\Models\User::factory() : null;
            },
        ];
    }

    /**
     * Indicate that the mentor is approved.
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => MentorStatus::Approved,
            'approved_at' => fake()->dateTimeBetween('-3 months', 'now'),
            'approved_by' => \App\Models\User::factory(),
        ]);
    }

    /**
     * Indicate that the mentor is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => MentorStatus::Pending,
            'approved_at' => null,
            'approved_by' => null,
        ]);
    }

    /**
     * Indicate that the mentor is suspended.
     */
    public function suspended(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => MentorStatus::Suspended,
            'approved_at' => fake()->dateTimeBetween('-3 months', 'now'),
            'approved_by' => \App\Models\User::factory(),
        ]);
    }

    /**
     * Indicate that the mentor is rejected.
     */
    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => MentorStatus::Rejected,
            'approved_at' => null,
            'approved_by' => null,
        ]);
    }
}
