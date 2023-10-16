<?php

namespace App\Models;

use App\DataTransferObjects\Coupon\CouponData;
use App\Enums\CouponTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class Coupon extends Model
{
    use HasFactory;
    use WithData;

    protected string $dataClass = CouponData::class;

    protected $fillable = [
        'user_id',
        'code',
        'type',
        'discount',
    ];

    protected $casts = [
        'type' => CouponTypes::class,
    ];
}
