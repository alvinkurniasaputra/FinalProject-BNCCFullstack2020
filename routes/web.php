<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return redirect('/home');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/questions/create', 'QuestionController@create');
    Route::get('/questions/{question_id}/edit', 'QuestionController@edit');
    Route::post('/questions', 'QuestionController@store');
    Route::put('/questions/{question_id}', 'QuestionController@update');
    Route::delete('/questions/{question_id}', 'QuestionController@destroy');
    Route::post('/questions/{question_id}', 'QuestionController@closeThread');

    Route::post('/answers/{question_id}', 'AnswerController@store');
    Route::get('/answers/{question_id}/{answer_id}/edit', 'AnswerController@edit');
    Route::put('/answers/{question_id}/{answer_id}', 'AnswerController@update');
    Route::delete('/answers/{answer_id}', 'AnswerController@destroy');

    Route::post('/anscomments/{answer_id}', 'AnswerCommentController@store');
    Route::put('/anscomments/{comment_id}', 'AnswerCommentController@update');
    Route::delete('/anscomments/{comment_id}', 'AnswerCommentController@destroy');

    Route::post('/quecomments/{question_id}', 'QuestionCommentController@store');
    Route::put('/quecomments/{comment_id}', 'QuestionCommentController@update');
    Route::delete('/quecomments/{comment_id}', 'QuestionCommentController@destroy');
});
Route::get('/users', 'UserController@index');
Route::get('/users/{user_id}', 'UserController@show');
Route::get('/users/{user_id}/edit', 'UserController@edit');
Route::post('/users/{user_id}', 'UserController@update');
Route::post('/users/{user_id}/photo', 'UserController@update_photo');

Route::get('/questions', 'QuestionController@index');
Route::get('/questions/{question_id}', 'QuestionController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
