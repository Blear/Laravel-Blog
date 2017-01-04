<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/11/3
 * Time: 15:16
 */
namespace App\Http\ViewComposers;
use App\Map;
use App\Repositories\Frontend\Setting\SettingRepository;
use Illuminate\View\View;

class SettingComposer{
    protected $settings;
    public function __construct(SettingRepository $settings)
    {
        $this->settings=$settings;
    }

    public function compose(View $view){
        $view->with($this->settings->getSettingsByTag('website'));
    }

}