<?php

namespace App\ViewModels\Menu;

use App\Models\Menu;
use App\ViewModels\ViewModel;
use Illuminate\Support\Collection;

class GetMenuViewModel extends ViewModel
{

    public function menus(): Collection
    {
        return Menu::with('menu', 'coupon')->latest()->get()->map->getData();
    }
}
