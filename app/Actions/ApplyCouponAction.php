<?php

namespace App\Actions;

use App\Exceptions\CannotApplyCouponException;
use App\Models\Coupon;
use App\Models\Menu;

class ApplyCouponAction
{
    public function execute(Coupon $coupon, Menu $menu): void
    {
        try {
            $discount = $coupon->type->createCouponType($coupon)->getDiscount($menu);
            $menu->updateDiscount($discount, $coupon);
        } catch (CannotApplyCouponException $e) {
            throw $e;
        }
    }

}
