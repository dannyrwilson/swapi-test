<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SwapiApiController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('people', [SwapiApiController::class, 'index'])->name('peopleList');
Route::get('people/{id}', [SwapiApiController::class, 'index'])->name('personView');