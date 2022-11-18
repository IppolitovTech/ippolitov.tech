<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainMenu;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Route;

class MainMenuController extends Controller
{
    public function mainPage()
    {
        $currentLink = Route::getFacadeRoot()->current()->uri();
        $mainMenuLinks = MainMenu::query()
            ->get()
            ->toArray();
        foreach ($mainMenuLinks as $link) {
            if ($currentLink == $link['link']) {
                $title = $link['title'];
            }
        }
        $portfolioWork = Portfolio::query()->where('work', 1)
            ->get()
            ->toArray();
        $portfolioClose = Portfolio::query()->where('work', 0)
            ->get()
            ->toArray();

        return view('pages/head')->with(compact('currentLink', 'mainMenuLinks', 'title', 'portfolioWork', 'portfolioClose'));
    }
}
