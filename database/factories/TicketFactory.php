<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['new', 'in_progress', 'processed']);

        return [
            'customer_id' => Customer::factory(),
            'theme' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'status' => $status,
            'answered_at' => $status === 'new' ? null : fake()->dateTimeBetween('-7 days', 'now'),
        ];
    }
}
