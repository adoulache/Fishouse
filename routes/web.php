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

// Route vers la page modelisation: (Peut-être qu'il sert plus à rien, A VERIFIER)
Route::get('/modelisation', function () {
    return view('modelisation');
})->name('modelisation');

// Route vers la page projet:
Route::post('/projets2', [ProjectController::class, 'addProject'])->name('ajoutProjet'); //Si jamais, changé nom en modelisation
//Route::post('/mes_projets1', [ProjectController::class, 'deleteProject']);
Route::post('/projets3', [ProjectController::class, 'deleteProject'])->name('suppProjet');
Route::post('/projets4', [ProjectController::class, 'renameProject'])->name('renameProjet');;
Route::post('/projets5', [ProjectController::class, 'shareProject'])->name('shareProjet');;

Route::get('/mes_projets', [ProjectController::class, 'Aquarium'])->name('projet');


// Route vers la page forum:
Route::get('/forum', function () {
    return view('forum');
})->name('forum');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
