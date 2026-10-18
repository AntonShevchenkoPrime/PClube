@extends('layouts.app')

@section('content')
<style>
    /* --- Шапка каталога --- */
    .games-header {
        margin-bottom: 30px;
    }

    .badge-library {
        display: inline-block;
        color: #ccff00;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .games-title {
        font-size: 36px;
        font-weight: 800;
        color: #fff;
        margin: 0;
    }

    /* --- Поиск --- */
    .search-box {
        display: flex;
        align-items: center;
        background-color: #1a1a1a;
        border: 1px solid #333;
        border-radius: 10px;
        padding: 10px 15px;
        width: 300px;
        transition: border-color 0.2s;
    }

    .search-box:focus-within {
        border-color: #ccff00;
    }

    .search-box svg {
        color: #666;
        margin-right: 10px;
    }

    .search-box input {
        background: transparent;
        border: none;
        color: #fff;
        font-size: 14px;
        outline: none;
        width: 100%;
    }

    .search-box input::placeholder {
        color: #666;
    }

    .games-subtitle {
        color: #888;
        font-size: 15px;
        margin: 0;
    }

    /* --- ФИЛЬТРЫ (ОБНОВЛЕНО) --- */
    .filter-tabs {
        display: inline-flex; /* Обёртка сжимается по размеру кнопок */
        gap: 5px;
        background-color: #1a1a1a; /* Тёмный фон капсулы */
        border: 1px solid #333;    /* Обводка капсулы */
        border-radius: 12px;       /* Скругление углов капсулы */
        padding: 5px;              /* Отступы внутри капсулы */
        margin-bottom: 30px;
    }

    .filter-tabs button {
        background-color: transparent;
        border: none;
        color: #666;
        padding: 8px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .filter-tabs button:hover {
        color: #ccc;
    }

    .filter-tabs button.active {
        background-color: #2a2a2a; /* Активная кнопка чуть светлее фона капсулы */
        color: #fff;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3); /* Легкая тень для объема */
    }

    /* --- Сетка карточек --- */
    .games-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 20px;
    }

    /* --- КАРТОЧКА ИГРЫ (ОБНОВЛЕНО) --- */
    .game-card {
        background-color: #141414;
        border: 1px solid #222;
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.2s, border-color 0.2s, box-shadow 0.2s; /* Добавили box-shadow в transition */
        cursor: pointer;
    }

    /* Эффект при наведении: подъем + зелёная рамка + лёгкое свечение */
    .game-card:hover {
        transform: translateY(-5px);
        border-color: rgba(204, 255, 0, 0.8); /* Зелёная рамка */
       
    }

    /* Обложка игры */
    .card-image {
        height: 180px;
        position: relative;
        background: linear-gradient(135deg, #1a0b2e 0%, #0d0d0d 100%);
        display: flex;
        align-items: flex-end;
        padding: 15px;
    }

    .card-image.cyberpunk {
        background: linear-gradient(135deg, #001a1a 0%, #0d0d0d 100%);
    }

    .card-image.fc25 {
        background: linear-gradient(135deg, #1a001a 0%, #0d0d0d 100%);
    }

    .badge-available {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: rgba(204, 255, 0, 0.1);
        color: #ccff00;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.5px;
        border: 1px solid rgba(204, 255, 0, 0.3);
    }

    .platform-tags {
        display: flex;
        gap: 5px;
    }

    .platform-tag {
        background-color: rgba(0, 0, 0, 0.6);
        border: 1px solid #444;
        color: #fff;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
    }

    .card-info {
        padding: 15px;
    }

    .card-title {
        font-size: 18px;
        font-weight: 700;
        color: #fff;
        margin: 0 0 8px 0;
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

<div class="games-header">
    <div class="badge-library">БИБЛИОТЕКА</div>
    
    <div class="header-top">
        <h1 class="games-title">Каталог игр</h1>
        
        <div class="search-box">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" placeholder="Найти игру...">
        </div>
    </div>
    
    <p class="games-subtitle">Выберите платформу — все игры уже установлены и готовы к запуску.</p>
</div>

<div class="filter-tabs">
    <button class="active">Все платформы</button>
    <button>PC</button>
    <button>Консоли</button>
    <button>VR</button>
</div>

<div class="games-grid">
    <!-- Карточка 1: Counter-Strike 2 -->
    <div class="game-card">
        <div class="card-image">
            <span class="badge-available">ЭКСКЛЮЗИВ</span>
            <div class="platform-tags">
                <span class="platform-tag">PC</span>
            </div>
        </div>
        <div class="card-info">
            <h3 class="card-title">Counter-Strike 2</h3>
            <div class="card-meta">
                <span>PC</span> • <span class="status-installed">Установлено</span>
            </div>
        </div>
    </div>

    <!-- Карточка 2: Cyberpunk 2077 -->
    <div class="game-card">
        <div class="card-image cyberpunk">
            <span class="badge-available">ДОСТУПНО</span>
            <div class="platform-tags">
                <span class="platform-tag">PC</span>
                <span class="platform-tag">PS5</span>
            </div>
        </div>
        <div class="card-info">
            <h3 class="card-title">Cyberpunk 2077</h3>
            <div class="card-meta">
                <span>PC</span> • <span>Консоль</span> • <span class="status-installed">Установлено</span>
            </div>
        </div>
    </div>

    <!-- Карточка 3: EA Sports FC 25 -->
    <div class="game-card">
        <div class="card-image fc25">
            <span class="badge-available">ДОСТУПНО</span>
            <div class="platform-tags">
                <span class="platform-tag">PC</span>
                <span class="platform-tag">PS5</span>
            </div>
        </div>
        <div class="card-info">
            <h3 class="card-title">EA Sports FC 25</h3>
            <div class="card-meta">
                <span>PC</span> • <span>Консоль</span> • <span class="status-installed">Установлено</span>
            </div>
        </div>
    </div>
</div>
@endsection