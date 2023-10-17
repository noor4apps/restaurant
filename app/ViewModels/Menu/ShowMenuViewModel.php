<?php

namespace App\ViewModels\Menu;

use App\DataTransferObjects\Menu\MenuData;
use App\Models\Coupon;
use App\Models\Menu;
use App\ViewModels\ViewModel;
use Illuminate\Support\Collection;

class ShowMenuViewModel extends ViewModel
{
    public function __construct(public readonly ?Menu $menu = null)
    {
    }

    public function menu(): ?MenuData
    {
        if (!$this->menu) {
            return null;
        }

        return $this->menu->getData();
    }

    public function coupons(): Collection
    {
        return Coupon::all()->map->getData();
    }
}
