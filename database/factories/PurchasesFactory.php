<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

// Imports
use App\Models\Purchases;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_name' => $this->faker->name,
            'material_code' => Str::random(5),
            'material' => $this->faker->word,
            'supplier' => $this->faker->company,
            'amount' => $this->faker->randomFloat(4, 100, 1000),
            'user_id' => $this->faker->numberBetween(1, 5),
            'date_of_purchase' => $this->faker->date,
            'reason' => $this->faker->sentence,
        ];
    }
}
