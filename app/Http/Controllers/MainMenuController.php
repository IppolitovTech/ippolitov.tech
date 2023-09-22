<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainMenu;
use App\Models\Portfolio;
use App\Models\PagesData;
use Illuminate\Support\Facades\Route;

class MainMenuController extends Controller
{
    private function getCommonData()
    {
        $currentLink = Route::getFacadeRoot()->current()->uri();
        $mainMenuLinks = MainMenu::all()->toArray();

        $title = null;
        foreach ($mainMenuLinks as $link) {
            if ($currentLink == $link['link']) {
                $title = $link['title'];
                break;
            }
        }

        $portfolioWork = Portfolio::where('work', 1)->orderBy('sort')->get()->toArray();
        $portfolioClose = Portfolio::where('work', 2)->orderBy('sort')->get()->toArray();

        $pageData = [];

        return compact('currentLink', 'mainMenuLinks', 'title', 'portfolioWork', 'portfolioClose', 'pageData');
    }

    public function onePage(Request $request, $id)
    {
        $page = $id;

        if (!$page) {
            abort(404);
        }

        $data = $this->getCommonData();
        $data = array_merge($data, ['currentLink' => "page"]);

        if (is_numeric($id)) {
            try {
                $pageData = PagesData::where('id', $id)->firstOrFail()->toArray();
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                abort(404);
            }
        } else {
            try {
                $pageData = PagesData::where('link', $id)->firstOrFail()->toArray();
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                abort(404);
            }
        }

        $data = array_merge($data, ['pageData' => $pageData]);

        return view('pages/head')->with(array_merge($data, ['id' => $id]));
    }

    public function mainPage()
    {
        $data = $this->getCommonData();

        return view('pages/head')->with($data);
    }
}
