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

Route::get('/', 'DashboardController@index');

Route::group(['prefix' => '/homestead'], function(){
   Route::get('/add', 'HomesteadController@addBox');
   Route::post('/add', 'HomesteadController@store');

   Route::get('/{id}', 'HomesteadController@view');
   Route::get('/{id}/task/{task}', 'HomesteadController@task');

   Route::get('/{id}/sites/refresh', 'HomesteadController@fetchSites');


   Route::get('/{id}/sites/add', 'HomesteadController@addSite');

   Route::post('/{id}/sites/add', 'HomesteadController@storeSite');
   Route::get('/{id}/sites/{siteId}', 'HomesteadController@viewSite');
   Route::get('/{id}/db-export', 'HomesteadController@exportDatabase');
});


Route::get('/terminal/tail/{log}', 'TerminalController@view');
Route::get('/terminal/tail-view/{log}', 'TerminalController@tail');
Route::get('/terminal/site-log/{id}', 'TerminalController@siteLog');
Route::get('/terminal/fetch-log/{id}', 'TerminalController@fetchLog');