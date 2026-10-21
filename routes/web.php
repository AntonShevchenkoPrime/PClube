<?php

use Illuminate\Support\Facades\Route;
use App\Models\GamesLibrary;
use App\Http\Controllers\GameController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/start', function () {
    return view('start');
})->name('start');

Route::get('/halls', function () {
    return view('halls');
})->name('halls');

Route::get('/booking', function () {
    return view('booking');
})->name('booking');

Route::get('/games', function () {
    $games = GamesLibrary::all(); 
    return view('games', ['games' => $games]);
})->name('games');

Route::get('/management', function () {
    return redirect()->route('management.games.index');
})->name('management');

Route::resource('management/games', GameController::class)->names([
    'index' => 'management.games.index',
    'create' => 'management.games.create',
    'store' => 'management.games.store',
    'edit' => 'management.games.edit',
    'update' => 'management.games.update',
    'destroy' => 'management.games.destroy',
]);


Route::get('/cabinet', function () {
    return view('cabinet');
})->name('cabinet');


// Route::get('/games_libraries', 
//     [App\Http\Controllers\GamesLibraryController::class, 'index']) 
//     ->name('games_libraries.php');