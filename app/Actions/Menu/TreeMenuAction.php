<?php

namespace App\Actions\Menu;

use App\Models\Menu;

class TreeMenuAction
{
    private static int $childrenSubCategoryCount = 0;

    public static function tree($id = null)
    {
        $allMenus = Menu::get();

        if (!is_null($id)) {
            $rootMenus = $allMenus->where('id', $id);
        } else {
            $rootMenus = $allMenus->whereNull('menu_id');
        }

        self::formatTree($rootMenus, $allMenus, $id);
        return $rootMenus;
    }

    private static function formatTree($menus, $allMenus, $id = null): void
    {
        foreach ($menus as $menu) {
            if (!is_null($id)) {
                $menu->children = $allMenus->where('menu_id', $menu->id)->values();
                self::$childrenSubCategoryCount = count($menu->children->keys());
                break;
            }

            if ($menu->children->isNotEmpty()) {
                self::formatTree($menu->children, $allMenus, $id);
            }
        }
    }

    public static function CheckMaximumLevelSubcategories($idSubCategory, int $maximumLevel): bool
    {
        self::tree($idSubCategory);
        if (self::$childrenSubCategoryCount >= $maximumLevel) {
            return true;
        }

        return false;
    }
}
