<?php

namespace App\DataTransferObjects\Coupon;

use App\Enums\CouponTypes;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;

class CouponData extends Data
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $code,
        #[WithCast(EnumCast::class)]
        public readonly CouponTypes $type,
        public readonly float $discount,
    ) {}

}
