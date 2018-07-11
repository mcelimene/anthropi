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

Route::get('/', 'HomeController@index');

Route::resource('trainers', 'TrainersController');
Route::resource('formations', 'FormationsController');

Route::get('training-follow-up', 'TrainingFollowUpController@index');
Route::get('pdfview',array('as'=>'pdfview','uses'=>'TrainersController@pdfview'));
