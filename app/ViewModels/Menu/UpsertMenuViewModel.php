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

    public function categories(): Collection
    {
        return Menu::whereType(MenuTypes::Category)->get()->map->getData();
    }

    public function items(): Collection
    {

        return Menu::query()
            ->whereType(MenuTypes::Category)
            ->doesntHave('children')
            ->orWhereHas('children', function ($query) {
                $query->where('type', 'item');
            })->get()->map->getData();
    }
}
