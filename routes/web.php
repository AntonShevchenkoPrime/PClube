<?php

use Illuminate\Support\Facades\Route;

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
    return view('games');
})->name('games');

Route::get('/cabinet', function () {
    return view('cabinet');
})->name('cabinet');


Route::get('/games_libraries', 
    [App\Http\Controllers\GamesLibraryController::class, 'index']) 
    ->name('games_libraries.php');