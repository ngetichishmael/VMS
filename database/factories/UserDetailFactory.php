<?php

namespace Database\Factories;

use App\Models\UserDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = UserDetail::class;

    public function definition()
    {
        return [
            'phone_number' => $this->faker->phoneNumber,
            'secondary_phone_number' => $this->faker->phoneNumber,
            'date_of_birth' => $this->faker->date,
            'company' => $this->faker->company,
            'ID_number' => $this->faker->randomNumber(8),
            'image' => $this->faker->imageUrl(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'physical_address' => $this->faker->address,
        ];
    }
}
