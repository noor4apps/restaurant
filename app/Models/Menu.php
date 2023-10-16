<?php

namespace App\Models;

use App\Enums\MenuTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'menu_id',
        'price',
        'discounted_price',
        'discount_value',
        'coupon_id',
    ];

    protected $casts = [
        'type' => MenuTypes::class,
    ];
}
