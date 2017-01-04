<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/10/28
 * Time: 14:33
 */


if (! function_exists('access')) {
    /**
     * access辅助函数
     * @return \Illuminate\Foundation\Application|mixed
     */
    function access()
    {
        return app('access');
    }
}

if (! function_exists('gravatar')) {
    /**
     * Access the gravatar helper
     */
    function gravatar()
    {
        return app('gravatar');
    }
}
/**
 * 返回cdn的资源地址
 * @param $filepath
 * @return string
 */
function cdn($filepath)
{
    if (config('app.url_static')) {
        return config('app.url_static') . $filepath;
    } else {
        return config('app.url') . $filepath;
    }
}

/**
 * 返回cdn地址
 * @return mixed
 */
function get_cdn_domain()
{
    return config('app.url_static') ?: config('app.url');
}
