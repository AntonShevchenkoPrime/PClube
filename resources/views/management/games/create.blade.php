@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <h1 style="color: #fff; font-size: 32px; font-weight: 800; margin-bottom: 30px;">Добавление игры</h1>

    <div style="background: #141414; border: 1px solid #222; border-radius: 16px; padding: 30px;">
        <form action="{{ route('management.games.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; color: #888; font-size: 13px; margin-bottom: 8px;">Название игры *</label>
                    <input type="text" name="name" required style="width: 100%; background: #0d0d0d; border: 1px solid #333; color: #fff; padding: 12px; border-radius: 8px; outline: none;">
                </div>
                <div>
                    <label style="display: block; color: #888; font-size: 13px; margin-bottom: 8px;">Категория (например: PC, PS5) *</label>
                    <input type="text" name="category" required style="width: 100%; background: #0d0d0d; border: 1px solid #333; color: #fff; padding: 12px; border-radius: 8px; outline: none;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; color: #888; font-size: 13px; margin-bottom: 8px;">Тег (например: ЭКСКЛЮЗИВ)</label>
                    <input type="text" name="tag" style="width: 100%; background: #0d0d0d; border: 1px solid #333; color: #fff; padding: 12px; border-radius: 8px; outline: none;">
                </div>
                <div>
                    <label style="display: block; color: #888; font-size: 13px; margin-bottom: 8px;">Состояние (например: Установлено) *</label>
                    <input type="text" name="state" value="Установлено" required style="width: 100%; background: #0d0d0d; border: 1px solid #333; color: #fff; padding: 12px; border-radius: 8px; outline: none;">
                </div>
            </div>

            <div style="display: flex; gap: 20px; margin-bottom: 20px; align-items: flex-start;">
                <!-- Обложка -->
                <div style="flex: 1;">
                    <label style="display: block; color: #888; font-size: 13px; margin-bottom: 8px;">Обложка игры (jpg, png, webp)</label>
                    <input type="file" name="image" style="width: 100%; color: #aaa; padding: 10px; background: #0d0d0d; border: 1px dashed #444; border-radius: 8px;">
                </div>
                
                <!-- Рейтинг -->
                <div style="width: 150px;">
                    <label style="display: block; color: #888; font-size: 13px; margin-bottom: 8px;">Рейтинг *</label>
                    <input type="text" name="rating" required placeholder="9.5" style="width: 100%; background: #0d0d0d; border: 1px solid #333; color: #fff; padding: 12px; border-radius: 8px; outline: none;">
                </div>
            </div>

            <div style="margin-bottom: 30px;">
                <label style="display: block; color: #888; font-size: 13px; margin-bottom: 8px;">Описание игры</label>
                <textarea name="description" rows="3" style="width: 100%; background: #0d0d0d; border: 1px solid #333; color: #fff; padding: 12px; border-radius: 8px; outline: none;"></textarea>
            </div>

            <div style="display: flex; gap: 15px;">
                <button type="submit" style="background: #ccff00; color: #000; border: none; padding: 14px 30px; border-radius: 8px; font-weight: 700; cursor: pointer;">Сохранить</button>
                <a href="{{ route('management.games.index') }}" style="background: #222; color: #fff; padding: 14px 30px; border-radius: 8px; font-weight: 600; text-decoration: none;">Отмена</a>
            </div>
        </form>
    </div>
</div>
@endsection