<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PagesDatasController extends CrudController
{
    protected $fields = ['header', 'text', 'link', 'work'];

    protected $modelClass = Page::class;
}
