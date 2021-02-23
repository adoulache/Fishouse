<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModelisationController;

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

// Route vers la page d'accueil:
Route::get('/', function () {
    return view('home');
})->name('accueil');

// Route vers la page Fiches techniques:
Route::get('/fiches', function () {
    return view('fiches');
})->name('fiches');

// Route vers la page modelisation:
Route::get('/modelisation1', [ModelisationController::class, 'getProjet']);
Route::post('/modelisation2', [ModelisationController::class, 'postNom']);
Route::post('/modelisation3', [ModelisationController::class, 'postSauveProjet']);
Route::post('/modelisation4', [ModelisationController::class, 'postReinitProjet']);

Route::get('/modelisation', function () {
    return view('modelisation');
})->name('modelisation');

// Route vers la page forum:
Route::get('/forum', function () {
    return view('forum');
})->name('forum');

// Route vers inscription:
Route::get('/inscription', function () {
    return view('auth.register');
})->name('sign-up');

// Route vers connexion:
Route::get('/connexion', function () {
    return view('auth.login');
})->name('sign-in');

// Route vers le test Drag And Drop
Route::get('/testDrag', function () {
    return view('testDragAndDrop');
})->name('test-drag');


