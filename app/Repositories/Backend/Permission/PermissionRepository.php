<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/23
 * Time: 9:05
 */

namespace App\Repositories\Backend\Permission;


use App\Models\Permission\Permission;
use App\Repositories\Repository;

class PermissionRepository extends Repository
{
    const MODEL=Permission::class;
}