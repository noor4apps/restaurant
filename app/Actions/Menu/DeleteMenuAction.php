<?php

namespace App\Actions\Menu;

use App\Models\Menu;

class DeleteMenuAction
{
    public static function execute(Menu $menu): void
    {
        $menu->delete();
    }
}
