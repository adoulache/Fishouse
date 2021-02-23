<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

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
Route::get('/modelisation', function () {
    return view('modelisation');
})->name('modelisation');

// Route vers la page projet:
Route::post('/mes_projets', [ProjectController::class, 'addProject'])->name('ajoutProjet');;
Route::get('/mes_projets', [ProjectController::class, 'newAquarium'])->name('projet');

// Route vers la page forum:
Route::get('/forum', function () {
    return view('forum');
})->name('forum');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
