<?php

namespace App\ViewModels\Coupon;

use App\DataTransferObjects\Coupon\CouponData;
use App\Models\Coupon;
use App\ViewModels\ViewModel;

class UpsertCouponViewModel extends ViewModel
{
    public function __construct(public readonly ?Coupon $coupon = null)
    {
    }

    public function coupon(): ?CouponData
    {
        if (!$this->coupon) {
            return null;
        }

        return $this->coupon->getData();
    }
}
