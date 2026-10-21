@props(['game'])

<div class="game-card" data-name="{{ strtolower($game->name) }}" data-category="{{ strtolower($game->category) }}">
    <!-- Обертка для картинки -->
    <div class="card-image-wrapper">
        <!-- Слой с картинкой -->
        <div class="card-image-bg" style="background-image: url('{{ asset('images/' . $game->image) }}');"></div>
        
        <!-- Бейджи -->
        @if($game->tag)
            <span class="badge-available">{{ $game->tag }}</span>
        @endif
        
        <div class="platform-tags">
            @foreach(explode(',', $game->category) as $platform)
                <span class="platform-tag">{{ trim($platform) }}</span>
            @endforeach
        </div>
    </div>

    <div class="card-info">
        <h3 class="card-title">{{ $game->name }}</h3>
        <div class="card-meta">
            <span>{{ $game->category }}</span> • <span class="status-installed">{{ $game->state }}</span>
        </div>
    </div>
</div>

<style>
    /* КАРТОЧКА */
    .game-card {
        background-color: #141414;
        border: 1px solid #222;
        border-radius: 16px;
        transition: transform 0.2s, border-color 0.2s, box-shadow 0.2s;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        padding: 12px;
    }

    .game-card:hover {
        transform: translateY(-5px);
        border-color: rgba(204, 255, 0, 0.8);
    }

    /* ОБЕРТКА КАРТИНКИ */
    .card-image-wrapper {
        height: 210px;
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        background-color: #1a1a1a; 
    }

    /* СЛОЙ С КАРТИНКОЙ */
    .card-image-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        transition: transform 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        z-index: 1;

        pointer-events: none;
        user-select: none; 
    }

    /* Анимация увеличения */
    .game-card:hover .card-image-bg {
        transform: scale(1.08);
    }

    /* БЕЙДЖИ (Поверх картинки) */
    .badge-available {
        position: absolute;
        top: 15px;
        right: 15px;
        z-index: 2;
        background-color: rgba(13, 13, 13, 0.8);
        backdrop-filter: blur(4px);
        color: #ccff00;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.5px;
        border: 1px solid rgba(204, 255, 0, 0.3);
    }

    .platform-tags {
        position: absolute;
        bottom: 15px;
        left: 15px;
        z-index: 2;
        display: flex;
        gap: 5px;
    }

    .platform-tag {
        background-color: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(4px);
        border: 1px solid #444;
        color: #fff;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
    }

    /* ИНФОРМАЦИЯ */
    .card-info {
        padding: 15px 5px 5px 5px; 
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .card-title {
        font-size: 18px;
        font-weight: 700;
        color: #fff;
        margin: 0;
    }

    .card-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #888;
    }

    .status-installed {
        color: #ccff00;
        font-weight: 600;
    }
</style>