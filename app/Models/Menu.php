<?php

namespace App\Models;

use App\DataTransferObjects\Coupon\CouponData;
use App\DataTransferObjects\Menu\MenuData;
use App\Enums\MenuTypes;
use App\ValueObject\Discount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\WithData;

class Menu extends Model
{
    use HasFactory;
    use WithData;

    protected string $dataClass = MenuData::class;

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

    public function menu(): BelongsTo
    {
        return $this->belongsTo(self::class, 'menu_id');
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    public function updateDiscount(Discount $discount, Coupon $coupon): void
    {
        $this->discounted_price = $discount->discountedPrice;
        $this->discount_value = $discount->discountValue;
        $this->coupon_id = $coupon->id;

        $this->save();
    }

}
