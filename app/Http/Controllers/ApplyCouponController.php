<?php

namespace App\Http\Controllers;

use App\Actions\ApplyCouponAction;
use App\Exceptions\CannotApplyCouponException;
use App\Models\Coupon;
use App\Models\Menu;
use App\ViewModels\Menu\ShowMenuViewModel;
use Inertia\Inertia;
use Inertia\Response;
use Redirect;

class ApplyCouponController
{
    public function show(Menu $menu): Response
    {
        return Inertia::render('Menu/Content', [
            'model' => new ShowMenuViewModel($menu)
        ]);
    }

    public function apply(Menu $menu, Coupon $coupon, ApplyCouponAction $applyCoupon)
    {
        try {
            $applyCoupon->execute($coupon, $menu);
        } catch (CannotApplyCouponException $e) {

            return Redirect::back()->with('message', $e->getMessage());
        }
    }

}
