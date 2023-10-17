<?php

namespace Database\Factories;

use App\Enums\MenuTypes;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    public function definition()
    {
        $price = rand(10, 50) * 10 - 1;
        $discountValue = rand(10, 20) * 10 - 1;
        $discountedPrice = max($price - $discountValue, 0);

        return [
            'user_id' => User::factory(),
            'name' => $this->faker->word(),
            'type' => collect(MenuTypes::cases())->random(),
            'menu_id' => null,
            'price' => $price,
            'discount_value' => $discountValue,
            'discounted_price' => $discountedPrice,
            'coupon_id' => Coupon::factory(),
        ];
    }
}
