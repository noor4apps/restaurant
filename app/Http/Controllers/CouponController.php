<?php

namespace App\Http\Controllers;

use App\Actions\Coupon\DeleteCouponAction;
use App\Actions\Coupon\UpsertCouponAction;
use App\DataTransferObjects\Coupon\CouponData;
use App\Models\Coupon;
use App\ViewModels\Coupon\GetCouponViewModel;
use App\ViewModels\Coupon\UpsertCouponViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Redirect;

class CouponController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Coupon/List', [
            'model' => new GetCouponViewModel(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Coupon/Form', [
            'model' => new UpsertCouponViewModel(),
        ]);
    }

    public function store(CouponData $data, Request $request): RedirectResponse
    {
        UpsertCouponAction::execute($data, $request->user());

        return Redirect::route('coupons.index');
    }

    public function edit(Coupon $coupon): Response
    {
        return Inertia::render('Coupon/Form', [
            'model' => new UpsertCouponViewModel($coupon)
        ]);
    }

    public function update(CouponData $data, Request $request): RedirectResponse
    {
        UpsertCouponAction::execute($data, $request->user());

        return Redirect::route('coupons.index');
    }

    public function destroy(Coupon $coupon): RedirectResponse
    {
        DeleteCouponAction::execute($coupon);

        return Redirect::route('coupons.index');
    }
}
