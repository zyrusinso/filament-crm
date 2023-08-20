<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'region' => $this->faker->address,
            'country' => 'US',
            'postal_code' => $this->faker->postcode,
        ];
    }
}
