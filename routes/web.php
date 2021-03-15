<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
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
Route::get('/modelisation5', [ModelisationController::class, 'getPlantes']);
Route::get('/modelisation6', [ModelisationController::class, 'getDecos']);
Route::get('/modelisation7', [ModelisationController::class, 'getCheminPlante']);
Route::get('/modelisation8', [ModelisationController::class, 'getCheminDeco']);


// Route vers la page modelisation: (Peut-être qu'il sert plus à rien, A VERIFIER)
Route::get('/modelisation/{id}/{name}', [ModelisationController::class, 'openProject'])->name('openProjet');

Route::get('/ma_modelisation', [ModelisationController::class, 'catalogues'])->name('catalogue');
Route::post('/modelisation', [ModelisationController::class, 'addProject'])->name('ajoutProjet');

// Route::get('/modelisation', function () {
//     return view('modelisation');
// })->name('modelisation');

// Route vers la page projet:
Route::post('/projets3', [ProjectController::class, 'deleteProject'])->name('suppProjet');
Route::post('/projets4', [ProjectController::class, 'renameProject'])->name('renameProjet');
Route::post('/projets5', [ProjectController::class, 'shareProject'])->name('shareProjet');

Route::get('/mes_projets', [ProjectController::class, 'Aquarium'])->name('projet');

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


