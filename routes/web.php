<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//登录认证
Auth::routes();
Route::get('/logout',function(){
        Auth::logout();
        return 'logout success';
});
Route::get('/','Admin\SitesController@index')->middleware('auth');

/*
 * @desc 定义路由控制器命名空间,和路由前缀的下的控制器
 */
Route::group(
    ['namespace'=>'Admin','prefix'=>'admin','middleware'=>['auth','permission']],
    function(){
                //home route
                Route::get('/home','SitesController@index');
                Route::get('/index','SitesController@index');
                Route::get('/welcome','SitesController@welcome');
                Route::get('/show','SitesController@show');

                //permission route,not acl
                Route::get('/permission/view','PermissionController@getView')->name('permission');
                Route::get('/permission/create','PermissionController@getCreate');
                Route::post('/permission/create','PermissionController@postCreate');
                Route::get('/permission/modify','PermissionController@getModify');
                Route::post('/permission/modify','PermissionController@postModify');
                Route::get('/permission/remove','PermissionController@getRemove');

                //users route
                Route::get('/users/view','UsersController@getView')->name('users');
                Route::get('/users/create','UsersController@getCreate');
                Route::post('/users/create','UsersController@postCreate');
                Route::get('/users/modify','UsersController@getModify');
                Route::post('/users/modify','UsersController@postModify');
                Route::get('/users/remove','UsersController@getRemove');
    }
);

/*
 * @todo 定义错误或通知视图路由
 */
Route::get('/no-permission','NoticeController@AdminUserNoPermission');
