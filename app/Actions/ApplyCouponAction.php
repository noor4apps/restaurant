<?php

namespace App\Actions;

use App\Models\Coupon;
use App\Models\Menu;

class ApplyCouponAction
{
    public function execute(Coupon $coupon, Menu $menu): void
    {
        $discount = $coupon->type->createCouponType($coupon)->getDiscount($menu);

        $menu->updateDiscount($discount, $coupon);
    }

}
