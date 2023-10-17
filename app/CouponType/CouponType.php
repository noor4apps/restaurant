<?php

namespace App\CouponType;

use App\Models\Coupon;
use App\Models\Menu;
use App\Models\Order;
use App\ValueObject\Discount;

abstract class CouponType
{
    public function __construct(protected readonly Coupon $coupon)
    {
    }

    abstract public function getDiscount(Menu $menu): Discount;
}
