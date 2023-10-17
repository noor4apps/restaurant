<?php


use App\Enums\CouponConditions;
use App\Enums\CouponTypes;
use App\Models\Coupon;
use App\Models\Menu;
use App\Models\Order;
use App\Models\User;
use App\ValueObject\CouponCondition;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ApplyCouponTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_apply_coupon()
    {
        $user = User::factory()->create();

        // Given
        $menu = Menu::factory([
            'price' => 100,
            'discounted_price' => 100,
            'discount_value' => 0,
            'coupon_id' => null,
        ])->create();

        $coupon = Coupon::factory([
            'type' => CouponTypes::Item,
            'discount' => 20,
        ])->create();

        // When
        $this->actingAs($user)->patch(route('coupons.apply', compact('menu', 'coupon')));

        // Then
        $this->assertDatabaseHas('menus', [
            'id' => $menu->id,
            'price' => 100,
            'discounted_price' => 80,// orders.price - coupons.discount == 100 - 20 = 80
            'discount_value' => 20,// order.price - discounted_price == 100 - 80
            'coupon_id' => $coupon->id,
        ]);
    }

}
