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
        public readonly ?int $id,
        public readonly string $name,
        #[WithCast(EnumCast::class)]
        public readonly MenuTypes $type,
        public readonly null|Lazy|MenuData $menu,
        public readonly float $price,
        public readonly ?float $discounted_price,
    ) {}

    public static function fromRequest(Request $request): self
    {

        return self::from([
            ...$request->all(),
            'menu' => MenuData::from(Menu::findOrNew($request->menu_id)),
        ]);
    }

    public static function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'type' => ['required', Rule::in(MenuTypes::cases())],
            'price' => ['required', 'string'],
            'menu_id' => ['required', 'exists:menus,id'],
        ];
    }

}
