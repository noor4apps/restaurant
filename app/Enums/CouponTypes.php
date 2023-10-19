<?php

namespace App\Enums;

use App\CouponType\Category;
use App\CouponType\CouponType;
use App\CouponType\Item;
use App\Models\Coupon;

enum CouponTypes: string
{
    case Category = 'category';
    case Item = 'item';

    public function createCouponType(Coupon $coupon): CouponType
    {
        return match ($this) {
            self::Category => new Category($coupon),
            self::Item => new Item($coupon),
        };
    }
}
