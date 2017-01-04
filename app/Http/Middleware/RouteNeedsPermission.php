<?php

namespace App\Http\Middleware;

use Closure;

class RouteNeedsPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$permission,$needsAll=false)
    {
        if(strpos($permission,';')){
            $permissions=explode(';',$permission);
            $access=access()->hasPermissions($permissions,$needsAll=='true'?true:false);
        }else{
            $access=access()->hasPermission($permission,$needsAll=='true'?true:false);
        }
        if(!$access){
            //自定义权限不足页面
        }
        return $next($request);
    }
}
