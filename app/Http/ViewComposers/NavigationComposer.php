<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/11/3
 * Time: 15:16
 */
namespace App\Http\ViewComposers;
use App\Repositories\Frontend\Navigation\NavigationRepository;
use Illuminate\View\View;

class NavigationComposer{
    protected $navigations;
    public function __construct(NavigationRepository $navigations)
    {
        $this->navigations=$navigations;
    }
    public function compose(View $view){
        $navigations=$this->navigations->getNavigations();
        $view->with('navigations',$navigations);
    }

}