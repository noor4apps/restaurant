<?php

namespace App\Http\Controllers;

use App\Actions\ApplyCouponAction;
use App\Models\Coupon;
use App\Models\Menu;
use App\ViewModels\Menu\ShowMenuViewModel;
use Inertia\Inertia;
use Inertia\Response;

class ApplyCouponController
{
    public function show(Menu $menu): Response
    {
        return Inertia::render('Menu/Content', [
            'model' => new ShowMenuViewModel($menu)
        ]);
    }

    public function apply(Menu $menu, Coupon $coupon, ApplyCouponAction $applyCoupon): void
    {
        $applyCoupon->execute($coupon, $menu);
    }

}
