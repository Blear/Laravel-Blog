<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/29
 * Time: 11:44
 */

namespace App\Repositories\Frontend\Setting;


use App\Models\Setting\Setting;
use App\Repositories\Repository;

class SettingRepository extends Repository
{
    const MODEL=Setting::class;

    public function getSettingsByTag($tag)
    {
        $settings=$this->query()
            ->where('tag',$tag)
            ->get();
        $settingsArray=[];
        foreach($settings as $setting){
            $settingsArray[$setting->key]=$setting->value;
        }
        return $settingsArray;
    }
}