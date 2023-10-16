<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainMenu;
use App\Models\Portfolio;
use App\Models\Page;
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

        $pageData = $this->getStaticPage();

        return compact('currentLink', 'mainMenuLinks', 'title', 'portfolioWork', 'portfolioClose', 'pageData');
    }

    private function getStaticPage()
    {
        $pageData['pages']['current'] = [];
        $pageData['pages']['home'] = $this->getOnePageData("/");
        $pageData['pages']['contacts'] = $this->getOnePageData("contacts");
        return $pageData;
    }

    public function onePage(Request $request, $id)
    {
        $page = $id;

        if (!$page) {
            abort(404);
        }

        $data = $this->getCommonData();
        $data = array_merge($data, ['currentLink' => "page"]);

        $pageData = $this->getOnePageData($id);
        $pageData = $this->getStaticPage();
        $pageData['pages']['current'] = $this->getOnePageData($id);

        $data = array_merge($data, ['pageData' => $pageData]);
        $data = array_merge($data, ['blog' => $this->getDataBlog()]);

        

        return view('pages/head')->with(array_merge($data, ['id' => $id]));
    }

    public function mainPage()
    {
        $data = $this->getCommonData();

        $data = array_merge($data, ['blog' =>  $this->getDataBlog()]);

        return view('pages/head')->with($data);
    }


    public function getOnePageData($id)
    {
        if (is_numeric($id)) {
            try {
                $pageData = Page::where('id', $id)->firstOrFail()->toArray();
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                abort(404);
            }
        } else {
            try {
                $pageData = Page::where('link', $id)->firstOrFail()->toArray();
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                abort(404);
            }
        }

        return $pageData;
    }

    // public function showBlog()
    // {
    //     $pageData = Page::orderBy('updated_at', 'asc')->paginate(5);
    //     return view('pages.blog', compact('pageData'));
    // }

    public function getDataBlog()
    {
        //$pageData = Page::orderBy('updated_at', 'asc')->where('blog', 1)->paginate(5);
        $pageData = Page::orderBy('updated_at', 'asc')->where('blog', 1)->get()->toArray();

        // dd($pageData);
        // foreach ($pageData as &$page) {
        //     $text = strip_tags($page->text); // Удаляем HTML-теги
        //     $text = mb_strimwidth($text, 0, 350, "...");
        //     $page->text = $text;
        // }
        //  dd($pageData);
        return $pageData;



    }

    
    public function showBlog()
    {
        
        $blog = Page::orderBy('updated_at', 'asc')->where('blog', 1)->paginate(5);
        return view('pages.blog', compact('blog'));
    }
}
