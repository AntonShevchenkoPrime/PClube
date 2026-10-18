<?php

namespace App\Http\Controllers;

use App\Models\Games_Library;
use Illuminate\Http\Request;

class GamesLibraryController extends Controller
{
    public function index(Request $request){
     
        $games_libraries = \App\Models\Games_Library::all();
        return view('games_libraries.index', ['games_libraries' => $games_libraries]);
        
    }

}