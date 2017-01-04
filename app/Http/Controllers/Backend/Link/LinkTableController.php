<?php

namespace App\Http\Controllers\Backend\Link;

use App\Http\Requests\Backend\Link\ManageLinkRequest;
use App\Repositories\Backend\Link\LinkRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

class LinkTableController extends Controller
{
    //
    protected $links;
    public function __construct(LinkRepository $links)
    {
        $this->links=$links;
    }
    public function __invoke(ManageLinkRequest $request)
    {
        return Datatables::of($this->links->getForDataTable())
            ->addcolumn('actions',function($navigation){
                return $navigation->action_buttons;
            })
            ->make(true);
    }
}
