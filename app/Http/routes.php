<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    })->middleware('guest');



    Route::get('/tasks', 'TaskController@index');
    Route::post('/task', 'TaskController@store');
    Route::delete('/task/{task}', 'TaskController@destroy');
    
Route::get('catalog', 'CatalogController@index');//
Route::get('catalog/category/{id}', 'CatalogController@category');
Route::get('catalog/product/{id}', 'CatalogController@product');
// CRAWLING
Route::get('crawler/collectCategories', 'CrawlerController@collectCategories');
Route::get('crawler/collectProducts', 'CrawlerController@collectProducts');
Route::get('crawler/updateProducts', 'CrawlerController@updateProducts');
Route::get('crawler/updatePictures', 'CrawlerController@updatePictures');

    Route::auth();

});
//----------------------------------------------------------------------------
// ADD 
//Route::any('product/add', 'CatalogController@addProduct');
Route::any('product/change', 'CatalogController@changeProduct');
Route::any('product/remove', 'CatalogController@removeProduct');
Route::any('catalog/add', 'CatalogController@addCategory');
Route::any('catalog/change', 'CatalogController@changeCategory');
Route::any('catalog/remove', 'CatalogController@removeCategory');
//Route::get('add/category', 'ProductsController@addCategory');
Route::resource('product/add', 'CatalogController@addProduct');





//from https://www.codetutorial.io/how-to-craft-a-digital-e-shop-with-laravel/
Route::get('/admin/product/new', 'ProductController@newProduct');
Route::get('/admin/products', 'ProductController@index');
Route::get('/admin/product/destroy/{id}', 'ProductController@destroy');
Route::post('/admin/product/save', 'ProductController@add');
