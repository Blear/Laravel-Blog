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
    public function scopeActive($query, $status = true) {
        return $query->where('status', $status);
    }
}