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

Route::get('/',[
    'uses'=>'homeController@index',
    'as'=>'home'
]);
Route::get('/createAccount',[
    'uses'=>'AuthController@getSignUp',
    'as'=>'auth.createAccount',
    'middleware'=>['guest']
]);
Route::post('/createAccount',[
    'uses'=>'AuthController@postSignUp',
    'middleware'=>['guest']
]);
Route::get('/logIn',[
    'uses'=>'authController@getSignIn',
    'as'=>'auth.logIn',
    'middleware'=>['guest']
]);
Route::post('/logIn',[
    'uses'=>'authController@postSignIn',
    'middleware'=>['guest']
]);
Route::get('/personalInfo',[
    'uses'=>'personalInfoController@getInfo',
    'as'=>'personalInfo',
    'middleware'=>['auth'],
]);
Route::post('/personalInfo',[
    'uses'=>'personalInfoController@postInfo',
    'middleware'=>['auth'],
]);
Route::get('/logOut',[
    'uses'=>'AuthController@getlogOut',
    'as'=>'auth.logOut'
]);
Route::get('/blog/getBlog/{id}',[
    'uses'=>'blogController@getBlog',
    'as'=>'blog.getBlog',

]);
Route::get('/blogs/{user_id}',[
    'uses'=>'blogController@getBlogs',
    'as'=>'blog.getBlogs',
]);
Route::get('/deleteBlog/{blog_id}', [
    'uses' => 'blogController@getDeleteBlog',
    'as' => 'blog.delete',
    'middleware' => 'auth'
]);
Route::get('/blog/myBlogs',[
    'uses'=>'blogController@getMyBlogs',
    'as'=>'blog.getMyBlogs',
    'middleware'=>['auth'],
]);
Route::get('/blog/createBlogs',[
    'uses'=>'blogController@createBlogs',
    'as'=>'blog.createBlogs',
    'middleware'=>['auth'],
]);
Route::post('/blog/createBlogs',[
    'uses'=>'blogController@postBlogs',
    'middleware'=>['auth'],
]);
Route::get('/quizzer',[
    'uses'=>'testController@getIndex',
    'as'=>'quizzer.index',
]);
Route::get('/questions/{num}',[
    'uses'=>'testController@getQuestions',
    'as'=>'quizzer.questions',
]);
Route::post('/questions/{num}',[
    'uses'=>'testController@postQuestions',
]);
Route::get('/quizzer/checkAnswers',[
    'uses'=>'testController@getAnswers',
    'as'=>'quizzer.checkAnswers',
    'middleware'=>['auth'],
]);
Route::get('/quizzer/checkResults',[
    'uses'=>'testController@getResults',
    'as'=>'quizzer.checkResults',
]);
Route::post('/blog/{statusId}/reply',[
    'uses'=>'blogController@postReply',
    'as'=>'blog.reply',
    'middleware'=>['auth'],
]);
Route::post('/like',[
    'uses'=>'blogController@postLikeBlog',
    'as'=>'like'
]);
Route::get('/search',[
    'uses'=>'searchController@getSearchResult',
    'as'=>'search'
]);
Route::post('/edit', [
    'uses' => 'blogController@postEditBlog',
    'as' => 'edit'
]);