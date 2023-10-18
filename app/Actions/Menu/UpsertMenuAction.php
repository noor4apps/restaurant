<?php

namespace App\Actions\Menu;

use App\DataTransferObjects\Menu\MenuData;
use App\Exceptions\CannotAddNodeException;
use App\Models\Menu;
use App\Models\User;

class UpsertMenuAction
{
    const MAXIMUM_LEVEL_OF_SUBCATEGORIES = 4;

    public static function execut(MenuData $data, User $user)
    {

        if (TreeMenuAction::CheckMaximumLevelSubcategories($data->menu?->id, self::MAXIMUM_LEVEL_OF_SUBCATEGORIES)) {
            throw CannotAddNodeException::because('The Maximum level of subcategories is four');
        }

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
