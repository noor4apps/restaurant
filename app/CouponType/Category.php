<?php

namespace App\CouponType;

use App\Models\Menu;
use App\ValueObject\Discount;

class Category extends CouponType
{
    public function getDiscount(Menu $menu): Discount
    {
        $discountValue = min($this->coupon->discount, $menu->price);
        $discountedPrice = $menu->price - $discountValue;

        return new Discount($discountedPrice, $discountValue);
    }
}
