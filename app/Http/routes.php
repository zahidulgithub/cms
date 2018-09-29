<?php

use App\Post;

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

//insert using basic SQL
Route::get('/insert',function(){
    DB::insert('insert into posts(title,body) values(?,?)',['My 2nd post','php is also aweosome!']);
});

//read data using basic SQL
Route::get('/read',function(){
    $result=DB::select('select * from posts where id=?',[3]);
    foreach($result as $post){
        return $post->title;

    }
});

//update using basic SQL

Route::get('/update',function(){
    DB::update('update posts set title="UPDATED TITLE" where id=?',[1]);
});

//DELETE

Route::get('/delete',function(){
    $delete=DB::delete('delete from posts where id=?',[2]);

    if($delete!=1){
        return "Could not be deleted!";
    }else{
        return "Successfully deleted!";
    }
});

//eloquent

Route::get('/find',function(){
     $find=Post::all();
     foreach($find as $post){
         return $post->body;
     }
});

Route::get('/findwhere',function(){
    return $where=Post::where('id',2)->orderBy('id','desc')->take(1)->get();
});

Route::get('/findmore',function(){
    return $more=Post::findOrFail(2);
});

Route::get('/basicupdate',function(){
    $insert=Post::find(1);
    $insert->title="New ELO INSERT";
    $insert->body="New ELO BODY";
    $insert->save();
});

Route::get('/basicinsert',function(){
    $insert=new Post;
    $insert->title="New ELO INSERT";
    $insert->body="New ELO BODY";
    $insert->save();
});

Route::get('/multivalues',function(){
    Post::create(['title'=>'multi','body'=>'multi']);
});

//Route::get('/eloupdate',function(){
//    Post::where('id',2)->where('is_admin',0)->update(['title'=>'NEW TITLE','body'=>'NEW BODY']);
//});


//elo Update
Route::get('/eloupdate',function(){
    Post::where('id',4)->where('is_admin',0)->update(['title'=>'eloTitle','body'=>'EloBody']);
});

//elo delete

Route::get('/elodelete',function(){
    $delete=Post::find(4);
    $delete->delete();
});

//elo delete multiple
Route::get('/elomultdelete',function(){
    Post::destroy(2,3);
});

//Soft deletes

Route::get('/softdelete',function(){
    Post::find(8)->delete();
});
//readsoft
Route::get('/readsoft',function(){
//    $read=Post::find(9);
    $read=Post::onlyTrashed()->where('is_admin',0)->get();
    return $read;
});