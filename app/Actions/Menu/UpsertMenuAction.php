<?php

namespace App\Actions\Menu;

use App\DataTransferObjects\Menu\MenuData;
use App\Models\Menu;
use App\Models\User;

class UpsertMenuAction
{
    public static function execut(MenuData $data, User $user)
    {
//        dd($data->all());
        return Menu::updateOrCreate(
            [
                'id' => $data->id,
            ],
            [
                ...$data->all(),
                'menu_id' => $data->menu?->id,
                'user_id' => $user->id,
            ]
        );
    }
}
