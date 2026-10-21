@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <div>
        <h1 style="color: #fff; font-size: 32px; font-weight: 800; margin: 0;">Управление играми</h1>
        <p style="color: #888; margin-top: 5px;">Добавляйте, редактируйте и удаляйте игры в каталоге</p>
    </div>
    <a href="{{ route('management.games.create') }}" style="background: #ccff00; color: #000; padding: 12px 24px; border-radius: 8px; font-weight: 700; text-decoration: none; transition: 0.2s;">
        + Добавить игру
    </a>
</div>

@if(session('success'))
    <div style="background: rgba(204, 255, 0, 0.1); color: #ccff00; border: 1px solid rgba(204, 255, 0, 0.3); padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif

<div style="background: #141414; border: 1px solid #222; border-radius: 16px; overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 1px solid #222; color: #666; font-size: 12px; text-transform: uppercase;">
                <th style="padding: 15px 20px;">Картинка</th>
                <th style="padding: 15px 20px;">Название</th>
                <th style="padding: 15px 20px;">Категория</th>
                <th style="padding: 15px 20px;">Статус</th>
                <th style="padding: 15px 20px; text-align: right;">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($games as $game)
            <tr style="border-bottom: 1px solid #222; transition: background 0.2s;" onmouseover="this.style.background='#1a1a1a'" onmouseout="this.style.background='transparent'">
                <td style="padding: 15px 20px;">
                    @if($game->image)
                        <img src="{{ asset('images/' . $game->image) }}" alt="" style="width: 80px; height: 45px; object-fit: cover; border-radius: 6px;">
                    @else
                        <div style="width: 80px; height: 45px; background: #333; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #888;">Нет фото</div>
                    @endif
                </td>
                <td style="padding: 15px 20px; color: #fff; font-weight: 600;">{{ $game->name }}</td>
                <td style="padding: 15px 20px; color: #aaa;">{{ $game->category }}</td>
                <td style="padding: 15px 20px;">
                    <span style="background: rgba(204, 255, 0, 0.1); color: #ccff00; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600;">{{ $game->state }}</span>
                </td>
                <td style="padding: 15px 20px; text-align: right;">
                    <a href="{{ route('management.games.edit', $game->id) }}" style="color: #0a84ff; text-decoration: none; margin-right: 15px; font-weight: 500;">Изменить</a>
                    
                    <form action="{{ route('management.games.destroy', $game->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Удалить игру?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: #ff3b30; cursor: pointer; font-weight: 500; font-family: inherit; font-size: 14px;">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection