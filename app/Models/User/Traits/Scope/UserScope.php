<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/21
 * Time: 16:36
 */

namespace App\Models\User\Traits\Scope;


trait UserScope
{
    /**
     *根据账号状态过滤
     * @param $query
     * @param bool $status
     * @return mixed
     */
    public function scopeActive($query, $status = true) {
        return $query->where('status', $status);
    }
}