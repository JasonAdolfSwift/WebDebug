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
Route::get('/',  'HomePageController@index');
Route::get('/debug/next',  'NextController@index');
Route::get('/debug/stop', 'NextController@stop');
Route::get('/showSavedCode', 'HomePageController@show');
Route::get('/codeDetail', 'HomePageController@codeDetail');

Route::post('/code', 'CompileCodeController@index');
Route::post('/run', 'ExecuteController@index');
Route::post('/debug', 'DebugController@index');
Route::post('/debug/monitor', 'MonitorController@index');
Route::post('/debug/debuging', 'DebugingController@index');
Route::post('/debug/next', 'NextController@add');
Route::post('/saveCode', 'DebugController@save');

