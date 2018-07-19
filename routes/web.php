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


// Route pour les Admins
Route::resource('trainers', 'admin\TrainersController');
Route::resource('formations', 'admin\FormationsController');

Route::get('training-follow-up', 'admin\TrainingFollowUpController@index')->name('training-follow-up.index');
Route::put('training-follow-up', 'admin\TrainingFollowUpController@update')->name('training-follow-up.update');
Route::get('pdfview',array('as'=>'pdfview','uses'=>'admin\TrainersController@pdfview'));

Route::get('calendar', 'admin\CalendarController@index')->name('calendar.index');

// Route pour les Formateurs
Route::get('registration-formations', 'trainer\RegistrationFormationsController@index')->name('registration-formations.index');

// Authentification
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
