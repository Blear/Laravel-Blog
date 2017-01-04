<?php

use Illuminate\Database\Seeder;
use App\Models\Permission\Permission;
use Carbon\Carbon;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permission=new Permission();
        $permission->name='view-backend';
        $permission->display_name='查看后台';
        $permission->sort=1;
        $permission->created_at   = Carbon::now();
        $permission->updated_at   = Carbon::now();
        $permission->save();

        $permission=new Permission();
        $permission->name='manage-users';
        $permission->display_name='用户管理';
        $permission->sort=2;
        $permission->created_at   = Carbon::now();
        $permission->updated_at   = Carbon::now();
        $permission->save();

        $permission=new Permission();
        $permission->name='manage-roles';
        $permission->display_name='角色管理';
        $permission->sort=3;
        $permission->created_at   = Carbon::now();
        $permission->updated_at   = Carbon::now();
        $permission->save();

        $permission=new Permission();
        $permission->name='manage-articles';
        $permission->display_name='文章管理';
        $permission->sort=4;
        $permission->created_at   = Carbon::now();
        $permission->updated_at   = Carbon::now();
        $permission->save();

        $permission=new Permission();
        $permission->name='manage-categories';
        $permission->display_name='分类管理';
        $permission->sort=5;
        $permission->created_at   = Carbon::now();
        $permission->updated_at   = Carbon::now();
        $permission->save();

        $permission=new Permission();
        $permission->name='manage-tags';
        $permission->display_name='标签管理';
        $permission->sort=6;
        $permission->created_at   = Carbon::now();
        $permission->updated_at   = Carbon::now();
        $permission->save();


        $permission=new Permission();
        $permission->name='manage-pages';
        $permission->display_name='页面管理';
        $permission->sort=7;
        $permission->created_at   = Carbon::now();
        $permission->updated_at   = Carbon::now();
        $permission->save();

        $permission=new Permission();
        $permission->name='manage-navigations';
        $permission->display_name='导航管理';
        $permission->sort=8;
        $permission->created_at   = Carbon::now();
        $permission->updated_at   = Carbon::now();
        $permission->save();

        $permission=new Permission();
        $permission->name='manage-links';
        $permission->display_name='友链管理';
        $permission->sort=9;
        $permission->created_at   = Carbon::now();
        $permission->updated_at   = Carbon::now();
        $permission->save();

        $permission=new Permission();
        $permission->name='manage-setting';
        $permission->display_name='博客设置';
        $permission->sort=10;
        $permission->created_at   = Carbon::now();
        $permission->updated_at   = Carbon::now();
        $permission->save();

    }
}
