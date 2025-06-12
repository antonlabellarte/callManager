<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CampaignsRulesController;
use App\Http\Controllers\QueuesController;
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
// Elimina regola (delete)
Route::delete('/rules/{id}', RulesControllers::class . '@destroy')->name('rules.destroy')->middleware('auth');

/* Code */
// Lista code
Route::get('/queues/list', QueuesController::class .'@index')->name('queues.index')->middleware('auth');
// Nuove coda (create)
Route::get('/queues/create', QueuesController::class .'@create')->name('queues.create')->middleware('auth');
// Nuova coda (insert)
Route::post('/queues/storing', QueuesController::class .'@store')->name('queues.store')->middleware('auth');
// Modifica coda (form)
Route::get('/queues/{servizio}/edit', QueuesController::class .'@edit')->name('queues.edit')->middleware('auth');
// Aggiorna campagna regola (update)
Route::put('/queues/{servizio}/updating', QueuesController::class .'@update')->name('queues.update')->middleware('auth');

// Elimina coda (delete)
Route::delete('/queues/{id}', QueuesController::class . '@destroy')->name('queues.destroy')->middleware('auth');

/* Campagne */
// Campagne Regola
Route::get('/campaignsrules/list', CampaignsRulesController::class .'@index')->name('campaignsrules.index')->middleware('auth');
// Nuova campagna regola (create)
Route::get('/campaignrules/create', CampaignsRulesController::class .'@create')->name('campaignsrules.create')->middleware('auth');
// Nuova campagna regola (insert)
Route::get('/campaignrules/storing', CampaignsRulesController::class .'@store')->name('campaignsrules.store')->middleware('auth');
// Dettagli campagna regola
Route::get('campaignrules/details', CampaignsRulesController::class .'@details')->name('campaignrules.details')->middleware('auth');
// Modifica campagna regola (edit)
Route::get('campaignrules/edit', CampaignsRulesController::class .'@edit')->name('campaignrules.edit')->middleware('auth');
// Aggiorna campagna regola (update)
Route::put('/campaignrules/{id}', CampaignsRulesController::class . '@update')->name('campaignrules.update')->middleware('auth');
// Elimina regola (delete)
Route::delete('/campaignrules/{id}', CampaignsRulesController::class . '@destroy')->name('campaignsrules.destroy')->middleware('auth');

// Importa campagne tramite Excel
Route::post('/import-excel', CampaignsRulesController::class .'@import')->name('import.excel')->middleware('auth');
