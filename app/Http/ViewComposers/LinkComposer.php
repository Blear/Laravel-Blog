<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/11/3
 * Time: 15:16
 */
namespace App\Http\ViewComposers;
use App\Repositories\Frontend\Link\LinkRepository;
use Illuminate\View\View;

class LinkComposer{
    protected $links;
    public function __construct(LinkRepository $links)
    {
        $this->links=$links;
    }

    public function compose(View $view){
        $links=$this->links->getLinks();
        $view->with('links',$links);
    }

}