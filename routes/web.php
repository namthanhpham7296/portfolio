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

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('change-language/{language}', 'HomeController@changeLanguage')->name('user.change-language');
Route::post("sendContactMail", 'HomeController@sendContactMail');
Route::group(['middleware' => 'locale'], function() {
    Route::get('change-language/{language}', 'HomeController@changeLanguage')
        ->name('user.change-language');
});


Route::group(['prefix' => 'auth'], function(){
    route::post("login", 'Auth\AuthController@login')->name('auth.login');
    route::post("register", 'Auth\AuthController@register')->name('auth.register');
});


Route::group(['prefix' => 'admin'], function(){
    Route::group(['prefix' => 'dashboard'], function(){
        route::get("index", 'Admin\DashboardController@index')->name('admin.dashboard.index');
    });


    /**
     * User
     */
    Route::group(['prefix' => 'user'], function() {
        Route::get('index', 'Admin\UserController@index');
        Route::post('search', 'Admin\UserController@search');
        Route::get('profile/{page?}/{id?}', 'Admin\UserController@profile');
        Route::post('saveData', 'Admin\UserController@saveData');
        Route::post('delete', 'Admin\UserController@delete');
        Route::post('changeAvatar', 'Admin\UserController@changeAvatar');
        Route::post('removeAvatar', 'Admin\UserController@removeAvatar');
        Route::post('saveGeneral', 'Admin\UserController@saveGeneral');
        Route::post('changePassword', 'Admin\UserController@changePassword');
        Route::get('import', 'Admin\UserController@import');
        Route::post('saveImportData', 'Admin\UserController@saveImportData');
        Route::post('export', 'Admin\UserController@export');
        Route::post('saveAccessMenu', 'Admin\UserController@saveAccessMenu');
        Route::post('loadStore', 'Admin\UserController@loadStore');
    });

    /**
     * Company
     */
    Route::group(['prefix' => 'company'], function () {
        Route::get('index', 'Admin\CompanyController@index');
        Route::get('returnPolicy', 'Admin\CompanyController@returnPolicy');
        Route::get('privacyPolicy', 'Admin\CompanyController@privacyPolicy');
        Route::get('terms', 'Admin\CompanyController@terms');
        Route::get('profile/{page?}', 'Admin\CompanyController@profile');
        Route::post('saveGeneral', 'Admin\CompanyController@saveGeneral');
        Route::post('search', 'Admin\CompanyController@search');
        Route::post('saveData', 'Admin\CompanyController@saveData');
        Route::get('companyProfile', 'Admin\CompanyController@companyProfile');
        Route::post('updateMailerSetting', 'Admin\CompanyController@updateMailerSetting');
        Route::post('updateSNSSetting', 'Admin\CompanyController@updateSNSSetting');
        Route::post('updateSocial', 'Admin\CompanyController@updateSocial');
        Route::post('sendTestMail', 'Admin\CompanyController@sendTestMail');
        Route::post('saveReturnPolicy', 'Admin\CompanyController@saveReturnPolicy');
        Route::post('savePrivacyPolicy', 'Admin\CompanyController@savePrivacyPolicy');
        Route::post('saveTerms', 'Admin\CompanyController@saveTerms');

    });

    Route::group(['prefix' => 'site'], function(){
        Route::get('index', 'Admin\SiteController@index');
    });

    Route::group(['prefix' => 'siteMenu'], function(){
        Route::post('search', 'Admin\SiteMenuController@search');
        Route::post('saveData', 'Admin\SiteMenuController@saveData');
        Route::post('delete', 'Admin\SiteMenuController@delete');
        Route::post('changeRedirect', 'Admin\SiteMenuController@changeRedirect');
        Route::post('changePublic', 'Admin\SiteMenuController@changePublic');
        Route::post('rowReorder', 'Admin\SiteMenuController@rowReorder');
    });

    Route::group(['prefix' => 'siteResume'], function(){
        Route::post('search', 'Admin\SiteResumeController@search');
        Route::post('saveData', 'Admin\SiteResumeController@saveData');
        Route::post('delete', 'Admin\SiteResumeController@delete');
        Route::post('changePublic', 'Admin\SiteResumeController@changePublic');
        Route::post('rowReorder', 'Admin\SiteResumeController@rowReorder');
    });

    Route::group(['prefix' => 'siteSkill'], function(){
        Route::post('search', 'Admin\SiteSkillController@search');
        Route::post('saveData', 'Admin\SiteSkillController@saveData');
        Route::post('delete', 'Admin\SiteSkillController@delete');
        Route::post('changePublic', 'Admin\SiteSkillController@changePublic');
        Route::post('rowReorder', 'Admin\SiteSkillController@rowReorder');
    });
});
