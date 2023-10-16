<?php

namespace App\Enums;

enum CouponTypes: string
{
    case Menu = 'menu';
    case Category = 'category';
    case Item = 'item';
}
