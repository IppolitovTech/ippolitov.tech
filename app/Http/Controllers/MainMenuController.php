<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainMenu;

class MainMenuController extends Controller
{
    public function getAllLinks()
    {
        $mainMenuLinks = MainMenu::query()
            ->get()
            ->toArray();
        return response()->json($mainMenuLinks);
    }
}
