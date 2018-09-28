<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


//basic route
Route::get('/admin',function(){
    return "Hello admin!";
});

//naming route

Route::get('/admin/contact/office',array('as'=>'admin.contact',function(){
    $url=route('admin.contact');
    return $url;
}));

//Access controller method
Route::get('/contact/{id}/{name}','PostController@index');

//access and create route to all controller methods
Route::resource('/post','PostController');

//route for custom controller to view
Route::get('/user/{id}','PostController@user');

Route::get('/about',function(){
    return view('pages.about');
});

Route::get('/about/form','PostController@form');