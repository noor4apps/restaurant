<?php

namespace App\Actions\Coupon;

use App\Models\Coupon;

class DeleteCouponAction
{
    public static function execute(Coupon $coupon): void
    {
        $coupon->delete();
    }
}
