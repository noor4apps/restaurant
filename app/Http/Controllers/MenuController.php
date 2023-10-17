<?php

namespace App\Http\Controllers;

use App\Actions\Menu\DeleteMenuAction;
use App\Actions\Menu\UpsertMenuAction;
use App\DataTransferObjects\Menu\MenuData;
use App\Models\Menu;
use App\ViewModels\Menu\GetMenuViewModel;
use App\ViewModels\Menu\UpsertMenuViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Redirect;

class MenuController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Menu/List', [
            'model' => new GetMenuViewModel(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Menu/Form', [
            'model' => new UpsertMenuViewModel(),
        ]);
    }

    public function store(MenuData $data, Request $request): RedirectResponse
    {
        UpsertMenuAction::execut($data, $request->user());

        return Redirect::route('menus.index');
    }

    public function edit(Menu $menu): Response
    {
        return Inertia::render('Menu/Form', [
            'model' => new UpsertMenuViewModel($menu),
        ]);
    }

    public function update(MenuData $data, Request $request): RedirectResponse
    {
        UpsertMenuAction::execut($data, $request->user());

        return Redirect::route('menus.index');
    }

    public function destroy(Menu $menu): RedirectResponse
    {
        DeleteMenuAction::execute($menu);

        return Redirect::route('menus.index');
    }
}
