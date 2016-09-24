<?php

/*
|--------------------------------------------------------------------------
| Welcome Routes
|--------------------------------------------------------------------------
|
| 歓迎画面ルート
|
| 欢迎界面路由
|
*/

Route::get('/', 'HomeController@index');
Route::get('/lang/{lang}', 'HomeController@lang')->name('lang');

/*
|--------------------------------------------------------------------------
| Main Routes
|--------------------------------------------------------------------------
|
| メインルート
|
| 主要路由
|
*/

Route::group(['middleware' => 'auth', 'namespace' => 'Home'], function () {
    Route::get('home', 'HomeController@index');
    Route::get('home/profile', 'ProfileController@index');
});

Route::group(['middleware' => 'auth', 'namespace' => 'Project'], function () {
    Route::resource('project', 'ProjectController');
    Route::group(['prefix' => 'project/{project}'], function () {

        //Wiki路由
        Route::resource('wiki', 'WikiController');
        Route::post('wiki/first', 'WikiController@first');
        Route::group(['namespace' => 'Wiki'], function () {
            Route::resource('wiki-index', 'WikiTypeController');
        });

        //成员路由
        Route::resource('member', 'MemberController');
    });
});

/*
|--------------------------------------------------------------------------
| Logging In/Out Routes
|--------------------------------------------------------------------------
|
| ログイン関連ルート
|
| 认证路由
|
*/

Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

/*
|--------------------------------------------------------------------------
| Password Routes
|--------------------------------------------------------------------------
|
| パスワード関連ルート
|
| 密码重置
|
*/

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

/*
|--------------------------------------------------------------------------
| Test Routes
|--------------------------------------------------------------------------
|
| テストルート
|
| 测试路由
|
*/
