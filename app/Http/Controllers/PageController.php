<?php

namespace App\Http\Controllers;

use App\Repositories\Frontend\Page\PageRepository;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    protected $pages;
    public function __construct(PageRepository $pages)
    {
        $this->pages=$pages;
    }

    public function show($slug){
        $page=$this->pages->getPageBySlug($slug);
        return view('themes.page')->with(compact('page'));
    }
}
