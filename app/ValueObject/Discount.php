<?php

namespace App\ValueObject;

class Discount
{
    public function __construct(
        public readonly float $discountedPrice,
        public readonly float $discountValue,
    ) {}
}
