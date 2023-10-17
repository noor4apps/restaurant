<?php

namespace App\ViewModels\Menu;

use App\DataTransferObjects\Coupon\CouponData;
use App\DataTransferObjects\Menu\MenuData;
use App\Enums\MenuTypes;
use App\Models\Menu;
use App\ViewModels\ViewModel;
use Illuminate\Support\Collection;

class UpsertMenuViewModel extends ViewModel
{
    public function __construct(public readonly ?Menu $menu = null)
    {
    }

    public function menu(): ?MenuData
    {
        if (!$this->menu) {
            return null;
        }

        return $this->menu->load('menu')->getData();
    }

    public function menus(): Collection
    {
        return Menu::all()->map->getData();
    }
}
