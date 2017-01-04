<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/29
 * Time: 11:21
 */

namespace App\Repositories\Backend\Setting;


use App\Exceptions\GeneralException;
use App\Models\Setting\Setting;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;

class SettingRepository extends Repository
{
    const MODEL=Setting::class;

    public function saveSetting(array $input)
    {
        DB::transaction(function () use($input){
            foreach ($input as $key => $value) {
                $map=$this->query()->firstOrNew([
                    'key' => $key,
                ]);
                $map->tag = 'website';
                $map->value = $value;
                parent::save($map);
            }
            return true;
            throw new GeneralException('网站配置保存失败!');
        });
    }
}