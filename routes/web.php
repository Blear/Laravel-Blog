<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
//admin
Route::group(['prefix'=>'admin','middleware'=>'auth','namespace'=>'Backend','as'=>'admin.'],function(){
    Route::group(['middleware'=>'routeNeedsPermission:view-backend'],function(){
        //后台管理主页
        Route::get('/','HomeController@index')->name('home');
        //网站配置
        Route::match(['get', 'post'], '/setting', 'HomeController@setting')->name('setting');
        //清除缓存
        Route::get('/clear','HomeController@clear')->name('clear');
        //用户管理
        Route::group(['namespace' => 'User'], function() {
            //用户条目ajax接口
            Route::post('user/get', 'UserTableController')->name('user.get');
            //用户CRUD
            Route::resource('user','UserController',['except' => ['show']]);
            //禁用的用户
            Route::get('user/deactivated', 'UserStatusController@getDeactivated')->name('user.deactivated');
            //已删除的用户
            Route::get('user/deleted', 'UserStatusController@getDeleted')->name('user.deleted');
            //其他操作
            Route::group(['prefix'=>'user/{user}'],function(){
                //修改用户状态
                Route::get('mark/{status}', 'UserStatusController@mark')->name('user.mark')->where(['status' => '[0,1]']);
                //修改用户密码
                Route::get('password/change','UserPasswordController@edit')->name('user.change-password');
                Route::put('password/change','UserPasswordController@update')->name('user.change-password');
            });

            Route::group(['prefix'=>'user/{deletedUser}'],function(){
                //彻底删除
                Route::get('delete', 'UserStatusController@delete')->name('user.delete-permanently');
                //恢复删除
                Route::get('restore', 'UserStatusController@restore')->name('user.restore');
            });

        });

        //角色管理
        Route::group(['namespace'=>'Role'],function(){
            //角色条目ajax接口
            Route::post('role/get','RoleTableController')->name('role.get');
            //角色CRUD
            Route::resource('role','RoleController',['except'=>['show']]);
        });

        //文章分类管理
        Route::group(['namespace'=>'Category'],function(){
            //分类条目ajax接口
            Route::post('category/get','CategoryTableController')->name('category.get');
            //分类CRUD
            Route::resource('category','CategoryController',['except'=>['show']]);
        });

        //文章标签管理
        Route::group(['namespace'=>'Tag'],function(){
            //标签条目ajax接口
            Route::post('tag/get','TagTableController')->name('tag.get');
            //标签CRUD
            Route::resource('tag','TagController',['except'=>['show']]);
        });

        //文章管理
        Route::group(['namespace'=>'Article'],function(){
            //文章条目ajax接口
            Route::post('article/get','ArticleTableController')->name('article.get');
            //文章CRUD接口
            Route::resource('article','ArticleController',['except'=>['show']]);
            Route::post('upload','ArticleController@uploadImage')->name('upload');
            //草稿箱
            Route::get('article/draft', 'ArticleStatusController@getdraft')->name('article.draft');
            //已删除的文章
            Route::get('article/deleted', 'ArticleStatusController@getDeleted')->name('article.deleted');
            Route::group(['prefix'=>'article/{article}'],function(){
                //修改文章状态
                Route::get('mark/{status}', 'ArticleStatusController@mark')->name('article.mark')->where(['status' => '[0,1]']);
            });
            Route::group(['prefix'=>'article/{deletedArticle}'],function(){
                //彻底删除
                Route::get('delete', 'ArticleStatusController@delete')->name('article.delete-permanently');
                //恢复删除
                Route::get('restore', 'ArticleStatusController@restore')->name('article.restore');
            });
        });
        //页面管理
        Route::group(['namespace'=>'Page'],function(){
            //页面条目ajax接口
            Route::post('page/get','PageTableController')->name('page.get');
            //页面CRUD接口
            Route::resource('page','PageController',['except'=>['show']]);
        });
        //导航管理
        Route::group(['namespace'=>'Navigation'],function(){
            //导航条目ajax接口
            Route::post('navigation/get','NavigationTableController')->name('navigation.get');
            //导航CRUD接口
            Route::resource('navigation','NavigationController',['except'=>['show']]);
        });

        //友情连接管理
        Route::group(['namespace'=>'Link'],function(){
            //友情连接条目ajax接口
            Route::post('link/get','LinkTableController')->name('link.get');
            //友情连接CRUD接口
            Route::resource('link','LinkController',['except'=>['show']]);
        });
    });
});
//auth.login
Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login','Auth\LoginController@login');
Route::get('logout','Auth\LoginController@logout')->name('logout');
//Route::auth();
// Password Reset Routes...
Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm');
Route::post('password/reset','Auth\ResetPasswordController@reset');

Route::get('/', ['uses'=>'ArticleController@index','as'=>'article.index']);
Route::get('article/{slug}', ['uses'=>'ArticleController@show','as'=>'article.show']);
Route::get('category/{slug}',['uses'=>'CategoryController@show','as'=>'category.show']);
Route::get('tag/{name}',['uses'=>'TagController@show','as'=>'tag.show']);
Route::get('search',['uses'=>'SearchController@search','as'=>'article.search']);
Route::get('/{slug}',['uses'=>'PageController@show','as'=>'page.show']);

