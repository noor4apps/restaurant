<?php

namespace App\Actions\Coupon;

use App\DataTransferObjects\Coupon\CouponData;
use App\Models\Coupon;
use App\Models\User;

class UpsertCouponAction
{
    public static function execute(CouponData $data, User $user): Coupon
    {
        return Coupon::updateOrCreate(
            [
                'id' => $data->id,
            ],
            [
                ...$data->all(),
                'user_id' => $user->id,
            ]
        );

    }

}
