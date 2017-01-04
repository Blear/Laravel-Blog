<?php

namespace App\Http\Controllers\Backend\Page;

use App\Http\Requests\Backend\Page\ManagePageRequest;
use App\Repositories\Backend\Page\PageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

class PageTableController extends Controller
{
    //
    protected $pages;

    public function __construct(PageRepository $pages)
    {
        $this->pages=$pages;
    }

    public function __invoke(ManagePageRequest $request)
    {
        return Datatables::of($this->pages->getForDataTable())
            ->addColumn('actions',function($page){
                return $page->action_buttons;
            })
            ->make(true);
    }
}
