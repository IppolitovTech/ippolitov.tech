<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainMenu;
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
        return view('pages/head')->with(compact('currentLink', 'mainMenuLinks', 'title'));
    }
}
