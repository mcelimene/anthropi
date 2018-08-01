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
/* Suivi formations */
Route::get('training-follow-up', 'admin\TrainingFollowUpController@index')->name('training-follow-up.index');
Route::put('training-follow-up/{id}', 'admin\TrainingFollowUpController@validateFormation')->name('training-follow-up.validateFormation');
/* PDF */
Route::get('pdfview',array('as'=>'pdfview','uses'=>'admin\TrainersController@pdfview'));
/* Calendrier */
Route::get('calendar', 'admin\CalendarController@index')->name('calendar.index');
/* Messages groupés */
Route::get('messages/create', 'admin\MessagesController@create')->name('messages.create');
Route::post('messages/create', 'admin\MessagesController@send')->name('messages.send');
/* Profil */
Route::get('profils/{profil}/edit', 'admin\ProfilsController@edit')->name('profils.edit');
Route::put('profils/{profil}/edit', 'admin\ProfilsController@update')->name('profils.update');
Route::delete('profils/{profil}/edit', 'admin\ProfilsController@destroy')->name('profils.destroy');
/* Création admin */
Route::get('users/create', 'admin\UsersController@create')->name('users.create');
Route::post('users/create', 'admin\UsersController@store')->name('users.store');
/* Création niveau */
Route::get('levels/create', 'admin\LevelsController@create')->name('levels.create');
Route::post('levels/create', 'admin\LevelsController@store')->name('levels.store');
/*Datadock */
Route::get('datadock', 'admin\DatadockController@index')->name('datadock.index');
Route::get('datadock/create', 'admin\DatadockController@create')->name('datadock.create');
Route::post('datadock/create', 'admin\DatadockController@store')->name('datadock.store');
Route::get('datadock/data-trainers', 'admin\DatadockController@dataTrainers')->name('datadock.dataTrainers');
Route::post('datadock/data-trainers', 'admin\DatadockController@dataTrainersStore')->name('datadock.dataTrainersStore');

// Route pour les Formateurs
Route::get('registration-formations', 'trainer\RegistrationFormationsController@index')->name('registration-formations.index');

// Authentification
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');

// Appels à des fonctions Ajax
Route::put('/ajax', 'AjaxController@trainingFollowUp');
