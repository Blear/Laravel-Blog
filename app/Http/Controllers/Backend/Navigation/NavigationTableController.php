<?php

namespace App\Http\Controllers\Backend\Navigation;

use App\Http\Requests\Backend\Navigation\ManageNavigationRequest;
use App\Repositories\Backend\Navigation\NavigationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class NavigationTableController extends Controller
{
    //
    protected $navigations;

    public function __construct(NavigationRepository $naviagtions)
    {
        $this->navigations=$naviagtions;
    }

    public function __invoke(ManageNavigationRequest $request)
    {
        return Datatables::of($this->navigations->getForDataTable())
            ->addcolumn('actions',function($navigation){
                return $navigation->action_buttons;
            })
            ->make(true);
    }
}
