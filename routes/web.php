<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CampaignsRulesController;
use App\Http\Controllers\RulesControllers;

// Schermata di login
Route::get('/login', function () { return view('login');})->name('loginPage');
// Fase di login

Route::get('/logging', LoginController::class .'@login')->name('login');
// Rotta di logout
Route::get('/logout', LoginController::class .'@logout')->name('logout')->middleware('auth');

// Rotta iniziale
Route::get('/', function () { return view('welcome');})->middleware('auth');

/* Code */
// Lista regole
Route::get('/rules/list', RulesControllers::class .'@index')->name('rules.index')->middleware('auth');
// Nuove regola (create)
Route::get('/rules/create', RulesControllers::class .'@create')->name('rules.create')->middleware('auth');
// Nuova regola (insert)
Route::get('/rules/storing', RulesControllers::class .'@store')->name('rules.store')->middleware('auth');
// Elimina regola (delete)
Route::delete('/rules/{id}', RulesControllers::class . '@destroy')->name('rules.destroy')->middleware('auth');

/* Campagne */
// Campagne Regola
Route::get('/campaignsrules/list', CampaignsRulesController::class .'@index')->name('campaignslists.index')->middleware('auth');
// Nuova campagna regola (create)
Route::get('/rules/create', CampaignsRulesController::class .'@create')->name('campaignslists.create')->middleware('auth');
// Nuova campagna regola (insert)
Route::get('/rules/storing', CampaignsRulesController::class .'@store')->name('campaignslists.store')->middleware('auth');
// Elimina regola (delete)
Route::delete('/rules/{id}', CampaignsRulesController::class . '@destroy')->name('campaignslists.destroy')->middleware('auth');

// Importa campagne tramite Excel
Route::post('/import-excel', CampaignsRulesController::class .'@import')->name('import.excel')->middleware('auth');
