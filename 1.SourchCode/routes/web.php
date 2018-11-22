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

Route::get('/redirect/{social}', 'SocialAuthController@redirect');
Route::get('/callback/{social}', 'SocialAuthController@callback');

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

    //config
    Route::get('config', 'SystemController@configSystem')->name('configSystem');
    Route::post('config', 'SystemController@updateConfigSystem')->name('updateConfigSystem');

    
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
    Route::post('systems/editor', 'SystemController@editor')->name('indexEditor');

    //file manager
    Route::get('image', 'SystemController@imageManager')->name('imageManager');

    //article
    Route::get('article', 'ArticleController@index')->name('indexArticle');
    Route::get('article/create', 'ArticleController@create')->name('createArticle');
    Route::get('article/category', 'ArticleController@category')->name('categoryArticle');
    Route::get('article/category/create', 'ArticleController@createCategory')->name('createCategory');
    Route::post('article/category/store', 'ArticleController@storeCategory')->name('storeCategory');
    Route::get('article/category/{id}/edit', 'ArticleController@editCategory')->name('editCategory');
    Route::post('article/category/update', 'ArticleController@updateCategory')->name('updateCategory');

    Route::post('article', 'ArticleController@allArticle' )->name('allArticle');
});

