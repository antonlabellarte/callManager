<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CampaignsController;
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
// Lista campagne
Route::get('/campaigns/list', CampaignsController::class .'@index')->name('campaigns.index')->middleware('auth');
// Importa campagne tramite Excel
Route::post('/import-excel', CampaignsController::class .'@import')->name('import.excel')->middleware('auth');
