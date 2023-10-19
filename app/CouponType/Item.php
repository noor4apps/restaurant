<?php

namespace App\CouponType;

use App\Enums\MenuTypes;
use App\Exceptions\CannotApplyCouponException;
use App\Models\Menu;
use App\ValueObject\Discount;

class Item extends CouponType
{
    public function getDiscount(Menu $menu): Discount
    {
        if ($menu->type != MenuTypes::Item) {
            throw CannotApplyCouponException::because('The Coupon type is not item');
        }

        $discountValue = min($this->coupon->discount, $menu->price);
        $discountedPrice = $menu->price - $discountValue;

        return new Discount($discountedPrice, $discountValue);
    }
}
