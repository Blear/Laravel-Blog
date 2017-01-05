<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/10/28
 * Time: 14:33
 */


if (! function_exists('access')) {

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

function cdn($filepath)
{
    if (config('app.url_static')) {
        return config('app.url_static') . $filepath;
    } else {
        return config('app.url') . $filepath;
    }
}


function get_cdn_domain()
{
    return config('app.url_static') ?: config('app.url');
}
