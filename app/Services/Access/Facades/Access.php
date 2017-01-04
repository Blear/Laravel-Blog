<?php
namespace App\Services\Access\Facades;
use Illuminate\Support\Facades\Facade;

/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/20
 * Time: 13:33
 */
class Access extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'access';
    }
}