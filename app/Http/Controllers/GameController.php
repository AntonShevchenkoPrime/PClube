<?php

namespace App\Http\Controllers;

use App\Models\GamesLibrary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = GamesLibrary::latest()->get();
        return view('management.games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.games.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'tag' => 'nullable|string',
            'description' => 'nullable|string',
            'rating' => 'nullable|string',
            'state' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();

        // Обработка загрузки картинки
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        GamesLibrary::create($data);

        return redirect()->route('management.games.index')->with('success', 'Игра успешно добавлена!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GamesLibrary $game)
    {
        return view('management.games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GamesLibrary $game)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'state' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();

        // Если загружена новая картинка
        if ($request->hasFile('image')) {
            // Удаляем старую картинку, если она есть
            if ($game->image && File::exists(public_path('images/' . $game->image))) {
                File::delete(public_path('images/' . $game->image));
            }
            
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $game->update($data);

        return redirect()->route('management.games.index')->with('success', 'Игра обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GamesLibrary $game)
    {
        // Удаляем картинку из папки
        if ($game->image && File::exists(public_path('images/' . $game->image))) {
            File::delete(public_path('images/' . $game->image));
        }
        
        $game->delete();

        return redirect()->route('management.games.index')->with('success', 'Игра удалена!');
    }
}