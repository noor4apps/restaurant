<?php

namespace Database\Factories;

use App\Enums\CouponTypes;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'code' => $this->faker->word(),
            'type' => collect(CouponTypes::cases())->random(),
            'discount' => rand(1, 10) * 10 - 1,
        ];
    }
}
