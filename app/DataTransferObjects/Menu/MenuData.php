<?php

namespace App\DataTransferObjects\Menu;

use App\Enums\MenuTypes;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

class MenuData extends Data
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        #[WithCast(EnumCast::class)]
        public readonly ?MenuTypes $type = null,
        public readonly null|Lazy|MenuData $menu = null,
        public readonly ?float $price = null,
        public readonly ?float $discounted_price = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        $menuData = null;
        if ($request->has('menu_id')) {
            $menu = Menu::findOrNew($request->menu_id);
            $menuData = new self(
                id: $menu->id,
                name: $menu->name,
                type: $menu->type,
                price: $menu->price,
                discounted_price: $menu->discounted_price
            );
        }

        return self::from($request->all() + ['menu' => $menuData]);
    }

    public static function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'type' => ['required', Rule::in(MenuTypes::cases())],
            'price' => ['required', 'numeric'],
            'menu_id' => ['nullable', 'sometimes', 'exists:menus,id'],
        ];
    }
}
