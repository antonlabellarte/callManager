<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CampaignsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\RulesControllers;

// Schermata di login
Route::get('/login', function () { return view('login');})->name('loginPage');
// Fase di login

Route::get('/logging', LoginController::class .'@login')->name('login');
// Rotta di logout
Route::get('/logout', LoginController::class .'@logout')->name('logout')->middleware('auth');

// Rotta iniziale
Route::get('/', function () { return view('welcome');})->middleware('auth');

/* Regole */
// Lista regole
Route::get('/rules/list', RulesControllers::class .'@index')->name('rules.index')->middleware('auth');
// Nuove regola (create)
Route::get('/rules/create', RulesControllers::class .'@create')->name('rules.create')->middleware('auth');
// Nuova regola (insert)
Route::get('/rules/storing', RulesControllers::class .'@store')->name('rules.store')->middleware('auth');
// Modifica regola (form)
Route::get('/rules/{id}/edit', RulesControllers::class .'@edit')->name('rules.edit')->middleware('auth');
// Modifica regola (update)
Route::get('/rules/{id}/updating', RulesControllers::class .'@update')->name('rules.update')->middleware('auth');
// Elimina regola (delete)
Route::delete('/rules/{id}', RulesControllers::class . '@destroy')->name('rules.destroy')->middleware('auth');

/* Code */
// Lista code
Route::get('/services/list', ServicesController::class .'@index')->name('services.index')->middleware('auth');
// Nuove coda (create)
Route::get('/services/create', ServicesController::class .'@create')->name('services.create')->middleware('auth');
// Nuova coda (insert)
Route::post('/services/storing', ServicesController::class .'@store')->name('services.store')->middleware('auth');
// Modifica coda (form)
Route::get('/services/{servizio}/edit', ServicesController::class .'@edit')->name('services.edit')->middleware('auth');
// Aggiorna campagna regola (update)
Route::put('/services/{servizio}/updating', ServicesController::class .'@update')->name('services.update')->middleware('auth');
// Elimina coda (delete)
Route::delete('/services/{id}', ServicesController::class . '@destroy')->name('services.destroy')->middleware('auth');

/* Campagne */
// Campagne Regola
Route::get('/campaigns/list', CampaignsController::class .'@index')->name('campaigns.index')->middleware('auth');
// Nuova campagna regola (create)
Route::get('/campaignrules/create', CampaignsController::class .'@create')->name('campaigns.create')->middleware('auth');
// Nuova campagna regola (insert)
Route::post('/campaignrules/storing', CampaignsController::class .'@store')->name('campaigns.store')->middleware('auth');
// Dettagli campagna regola
Route::get('campaignrules/details', CampaignsController::class .'@details')->name('campaigns.details')->middleware('auth');
// Modifica campagna regola (edit)
Route::get('campaignrules/{id}/edit', CampaignsController::class .'@edit')->name('campaigns.edit')->middleware('auth');
// Aggiorna campagna regola (update)
Route::put('/campaignrules/{id}', CampaignsController::class . '@update')->name('campaigns.update')->middleware('auth');
// Elimina regola (delete)
Route::delete('/campaignrules/{id}', CampaignsController::class . '@destroy')->name('campaigns.destroy')->middleware('auth');

// Importa campagne tramite Excel
Route::post('/import-excel', CampaignsController::class .'@import')->name('import.excel')->middleware('auth');
