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

/*Route::get('/', function () {
    return view('CountryController@list');
});*/
Route::get('/', ['uses' => 'CountryController@index']);
Route::get('/list', ['as' => 'country.list', 'uses' => 'CountryController@list']);
Route::get('/list-file/{file}', 'CountryController@listFile')->name('country.list-file'); 
Route::get('/download/{file}', 'CountryController@download')->name('country.download');
Route::get('/excel/{file}', 'CountryController@excel')->name('country.excel');   
