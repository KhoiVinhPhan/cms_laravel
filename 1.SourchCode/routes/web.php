<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| anthor: khoivinhphan
| create: 10/10/2018
|
*/

Auth::routes();
//  Start Authentication Routes
Route::get('dang-nhap', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('dang-nhap', 'Auth\LoginController@login');
Route::post('dang-xuat', 'Auth\LoginController@logout')->name('logout');
Route::get('dang-ky', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('dang-ky', 'Auth\RegisterController@register');
//  End Authentication Routes

//-----------------------------------------FRONT END-----------------------------------------------
Route::get('/', function () {
    return view('welcome');
});

//-----------------------------------------BACK END------------------------------------------------

//PERMISSION: ADMINISTRATOR
Route::group(['middleware' => 'administrator', 'prefix' => 'manager', 'namespace'=>'Backend'], function () {
    //users
    Route::get('users', 'UserController@index')->name('indexUsers');
    Route::post('user/get-data-user-modal', 'UserController@getDataUserInModal')->name('getDataUserInModal');
    Route::post('user/edit-profile-is-admin', 'UserController@editProfileIsAdmin')->name('editProfileIsAdmin');
    Route::post('user/change-password', 'UserController@changePassword')->name('changePassword');
    Route::get('users/create', 'UserController@create')->name('createUser');
    Route::post('users/create', 'UserController@store')->name('storeUser');
    Route::post('user/check-mail', 'UserController@checkEmail')->name('checkEmail');
    Route::post('user/delete', 'UserController@delete')->name('deleteChoiceUser');
    Route::get('users/restore', 'UserController@restore')->name('restoreUser');
    Route::post('users/restore', 'UserController@restoreUsers')->name('restoreUsers');

    //category-article
    Route::get('category-article', 'ArticleController@index')->name('indexArticle');

    


});

//PERMISSION: USERS
Route::group(['middleware' => 'users', 'prefix' => 'manager', 'namespace'=>'Backend'], function () {
    
});

//PERMISSION: CUSTOMER
Route::group(['middleware' => 'customer', 'prefix' => 'manager', 'namespace'=>'Backend'], function () {
    Route::get('/', 'HomeController@index')->name('indexBackend');

    //users
    Route::get('user/profile', 'UserController@profile')->name('profile');
    Route::post('user/change-password-login','UserController@changePasswordLogin')->name('changePasswordLogin');
    Route::post('user/update', 'UserController@update')->name('updateUser');

    //systems
    Route::get('systems', 'SystemController@index')->name('indexSystem');
    Route::post('systems/pagination', 'SystemController@pagination')->name('pagination');
    Route::post('systems/colors', 'SystemController@colors')->name('colors');
    Route::post('systems/change-language', 'SystemController@changeLanguage')->name('changeLanguage');

    //file manager
    Route::get('image', 'UserController@image')->name('image');
});

