<?php

namespace App\Providers;

use App\Services\Access\Access;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AccessServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->registerBladeExtensions();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->registerAccess();
        $this->registerFacades();
    }

    /**
     * 把Access注册到服务容器
     */
    private function registerAccess(){
        $this->app->bind('access',function($app){
            return new Access($app);
        });
    }
    //注册Access门面
    private function registerFacades(){
        $this->app->booting(function(){
            $loader=\Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Access',\App\Services\Access\Facades\Access::class);
        });
    }
    //注册Blade扩展命令
    private function registerBladeExtensions()
    {
        /**
         * Role based blade extensions
         * Accepts either string of Role Name or Role ID
         */
        Blade::directive('role', function ($role) {
            return "<?php if (access()->hasRole({$role})): ?>";
        });

        /**
         * Accepts array of names or id's
         */
        Blade::directive('roles', function ($roles) {
            return "<?php if (access()->hasRoles({$roles})): ?>";
        });

        Blade::directive('needsroles', function ($roles) {
            return '<?php if (access()->hasRoles(' . $roles . ', true)): ?>';
        });

        /**
         * Permission based blade extensions
         * Accepts wither string of Permission Name or Permission ID
         */
        Blade::directive('permission', function ($permission) {
            return "<?php if (access()->hasPermission({$permission})): ?>";
        });

        /**
         * Accepts array of names or id's
         */
        Blade::directive('permissions', function ($permissions) {
            return "<?php if (access()->hasPermissions({$permissions})): ?>";
        });

        Blade::directive('needspermissions', function ($permissions) {
            return '<?php if (access()->hasPermissions(' . $permissions . ', true)): ?>';
        });

        /**
         * Generic if closer to not interfere with built in blade
         */
        Blade::directive('endauth', function () {
            return '<?php endif; ?>';
        });
    }
}
