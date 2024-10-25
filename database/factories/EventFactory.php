<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{

    protected $model = Event::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3), // Fake event name
            'location' => $this->faker->randomElement(['Malta', 'Brazil', 'Africa', 'Asia', 'East Europe', 'Eurasia']),    // Fake location
            'date' => $this->faker->date(),      // Fake date
            'description' => $this->faker->paragraph, // Fake description
        ];
    }
}
