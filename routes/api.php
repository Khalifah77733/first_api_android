<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Posts
//CRUD is basically
// 1 get all (GET) /api/posts
// 2 create a post (POST) /api/posts
// 3 get a single (GET) /api/posts/(id)
// 4 update a single (PUT/PATCH) /api/posts/(id)
// 5 delete (DELETE) /api/posts/(id)
//



/*
                //this code will be sure if your request is wrong
 * Route::put('/besure', function (){
   $post = \App\Post::find(2);
   $post->update(['title' => 'my new new new title']);

   return $post;
});*/


Route::prefix('v1')->group(function (){

    Route::apiResource('posts', 'PostController');

});




/*Route::get('/posts', 'PostController@index');

// insert route
Route::post('/posts', 'PostController@store');

// update
Route::put('/posts/id', 'PostController@update');

// delete
Route::delete('/posts/id', 'PostController@destroy');*/




Route::get('/testing_the_api', function (){
    return ['message' => 'hello'];
});



//////////////////////////////////////// THIS WILL BE NEW API FOR PROJECT BLOG \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');
Route::get('logout', 'Api\AuthController@logout');

//Possts

Route::post('possts/create', 'Api\PosstsController@create')->middleware('jwtAuth');
Route::delete('possts/delete', 'Api\PosstsController@delete')->middleware('jwtAuth');
Route::put('possts/update', 'Api\PosstsController@update')->middleware('jwtAuth');
Route::get('possts', 'Api\PosstsController@possts')->middleware('jwtAuth');

//Comments

Route::post('comments/create', 'Api\CommentsController@create')->middleware('jwtAuth');
Route::delete('comments/delete', 'Api\CommentsController@delete')->middleware('jwtAuth');
Route::put('comments/update', 'Api\CommentsController@update')->middleware('jwtAuth');
Route::get('possts/comments', 'Api\CommentsController@comments')->middleware('jwtAuth');

//Likes
Route::get('possts/like', 'Api\LikesController@like')->middleware('jwtAuth');







/////////////////////////////////////// END PROJECT OF BLOG \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
