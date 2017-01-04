<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ access()->user()->picture }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ access()->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">管理面板</li>


            <li class="{{ active_class(if_uri_pattern('admin')) }} treeview">
                <a href="{{ route('admin.home') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>管理主页</span>
                </a>
            </li>
            @permissions(['manage-users', 'manage-roles'])
            <li class="{{ active_class(if_controller(['App\Http\Controllers\Backend\User\UserController','App\Http\Controllers\Backend\User\UserStatusController','App\Http\Controllers\Backend\User\UserPasswordController','App\Http\Controllers\Backend\Role\RoleController'])) }} treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>权限管理</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu" >
                    @permission('manage-users')
                    <li class="{{ active_class(if_controller('App\Http\Controllers\Backend\User\UserController')||if_controller('App\Http\Controllers\Backend\User\UserStatusController')||if_controller('App\Http\Controllers\Backend\User\UserPasswordController')) }}">
                        <a href="{{ route('admin.user.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>用户管理</span>
                        </a>
                    </li>
                    @endauth

                    @permission('manage-roles')
                    <li class="{{ active_class(if_controller('App\Http\Controllers\Backend\Role\RoleController')) }}">
                        <a href="{{ route('admin.role.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>角色管理</span>
                        </a>
                    </li>
                    @endauth
                </ul>
            </li>
            @endauth

            <li class="{{ active_class(if_controller(['App\Http\Controllers\Backend\Category\CategoryController','App\Http\Controllers\Backend\Tag\TagController','App\Http\Controllers\Backend\Article\ArticleController','App\Http\Controllers\Backend\Article\ArticleStatusController','App\Http\Controllers\Backend\Page\PageController','App\Http\Controllers\Backend\Navigation\NavigationController','App\Http\Controllers\Backend\Link\LinkController'])) }} treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>博客管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @permission('manage-articles')
                    <li class="{{ active_class(if_controller('App\Http\Controllers\Backend\Article\ArticleController')||if_controller('App\Http\Controllers\Backend\Article\ArticleStatusController')) }}"><a href="{{route('admin.article.index')}}"><i class="fa fa-circle-o"></i>文章管理</a></li>
                    @endauth
                    @permission('manage-categories')
                    <li class="{{ active_class(if_controller('App\Http\Controllers\Backend\Category\CategoryController')) }}"><a href="{{route('admin.category.index')}}"><i class="fa fa-circle-o"></i>分类管理</a></li>
                    @endauth
                    @permission('manage-tags')
                    <li class="{{ active_class(if_controller('App\Http\Controllers\Backend\Tag\TagController')) }}"><a href="{{route('admin.tag.index')}}"><i class="fa fa-circle-o"></i>标签管理</a></li>
                    @endauth
                    @permission('manage-pages')
                    <li class="{{ active_class(if_controller('App\Http\Controllers\Backend\Page\PageController')) }}"><a href="{{route('admin.page.index')}}"><i class="fa fa-circle-o"></i>页面管理</a></li>
                    @endauth
                    @permission('manage-navigations')
                    <li class="{{ active_class(if_controller('App\Http\Controllers\Backend\Navigation\NavigationController')) }}"><a href="{{route('admin.navigation.index')}}"><i class="fa fa-circle-o"></i>导航管理</a></li>
                    @endauth
                    @permission('manage-links')
                    <li class="{{ active_class(if_controller('App\Http\Controllers\Backend\Link\LinkController')) }}"><a href="{{route('admin.link.index')}}"><i class="fa fa-circle-o"></i>友链管理</a></li>
                    @endauth
                </ul>
            </li>
            <li class="{{ active_class(if_route('admin.setting')) }} treeview">
                <a href="{{ route('admin.setting') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>网站配置</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>