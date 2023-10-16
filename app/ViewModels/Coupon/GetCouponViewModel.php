<?php

namespace App\ViewModels\Coupon;

use App\Models\Coupon;
use App\ViewModels\ViewModel;
use Illuminate\Support\Collection;

class GetCouponViewModel extends ViewModel
{

    public function coupons(): Collection
    {
        return Coupon::latest()->get()->map->getData();
    }
}
