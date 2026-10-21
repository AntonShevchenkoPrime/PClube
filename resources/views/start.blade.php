@extends('layouts.app')

@section('content')
<style>
    /* ГЛАВНЫЙ БАННЕР */
    .hero-section {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        padding: 60px 50px;
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-height: 520px;
        background-image: linear-gradient(rgba(13, 13, 13, 0.4), rgba(13, 13, 13, 0.9)), url('{{ asset('images/minecraft.jpg') }}');
        background-size: cover;
        background-position: center;
        background-color: #1a1a1a;
    }

    .badge-open {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: rgba(204, 255, 0, 0.1);
        color: #ccff00;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 30px;
        width: fit-content;
        border: 1px solid rgba(204, 255, 0, 0.2);
    }
    .badge-open::before {
        content: '';
        width: 6px;
        height: 6px;
        background-color: #ccff00;
        border-radius: 50%;
        box-shadow: 0 0 10px #ccff00;
    }

    .hero-title {
        font-size: 72px;
        font-weight: 900;
        line-height: 1.05;
        margin-bottom: 25px;
        letter-spacing: -1px;
        color: #fff;
    }
    .hero-title span {
        color: #ccff00;
        text-shadow: 0 0 30px rgba(204, 255, 0, 0.2);
    }

    .hero-desc {
        font-size: 17px;
        color: #aaa;
        max-width: 500px;
        line-height: 1.5;
        margin-bottom: 40px;
    }

    .hero-actions {
        display: flex;
        gap: 15px;
        margin-bottom: 50px;
    }

    .btn-primary {
        background-color: #ccff00;
        color: #000;
        padding: 16px 32px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 16px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.2s;
        box-shadow: 0 0 20px rgba(204, 255, 0, 0.2);
    }
    .btn-primary:hover {
        background-color: #b3e600;
        transform: translateY(-2px);
        box-shadow: 0 0 30px rgba(204, 255, 0, 0.4);
    }

    .btn-secondary {
        background-color: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        color: #fff;
        padding: 16px 32px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 16px;
        text-decoration: none;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.2s;
    }
    .btn-secondary:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }

    .hero-features {
        display: flex;
        gap: 50px;
    }
    .feature-item {
        display: flex;
        flex-direction: column;
    }
    .feature-title {
        font-size: 20px;
        font-weight: 800;
        color: #fff;
        margin-bottom: 4px;
    }
    .feature-subtitle {
        font-size: 12px;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    /* ПЛАШКА БЫСТРОГО БРОНИРОВАНИЯ */
    .quick-booking {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #141414;
        border: 1px solid #2a2a2a;
        border-radius: 16px;
        padding: 20px 30px;
        margin-bottom: 60px;
    }

    .qb-left {
        display: flex;
        align-items: center;
        gap: 15px;
        padding-right: 30px;
        border-right: 1px solid #2a2a2a;
    }
    .qb-icon {
        width: 40px; height: 40px;
        background-color: rgba(204, 255, 0, 0.1);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: #ccff00;
    }
    .qb-text .title { color: #fff; font-weight: 700; font-size: 15px; margin-bottom: 2px; }
    .qb-text .subtitle { color: #666; font-size: 12px; }

    .qb-info {
        display: flex;
        gap: 40px;
        padding: 0 40px;
        flex: 1;
    }
    .qb-info-item {
        display: flex; flex-direction: column; gap: 4px;
    }
    .qb-info-item .label { color: #555; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; }
    .qb-info-item .value { color: #ccc; font-size: 13px; font-weight: 500; display: flex; align-items: center; gap: 6px; }
    .qb-info-item .value svg { color: #888; }

    .btn-find-spot {
        background-color: #ccff00;
        color: #000;
        padding: 14px 24px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 14px;
        text-decoration: none;
        transition: background 0.2s;
    }
    .btn-find-spot:hover { background-color: #b3e600; }

    /* СЕКЦИЯ ИГРОВЫЕ ЗОНЫ */
    .zones-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 25px;
    }
    .zones-header-left .badge { color: #ccff00; font-size: 11px; font-weight: 700; letter-spacing: 1px; margin-bottom: 8px; display: block; }
    .zones-header-left h2 { color: #fff; font-size: 32px; font-weight: 800; margin: 0; }
    .view-all { color: #888; text-decoration: none; font-size: 14px; display: flex; align-items: center; gap: 5px; transition: color 0.2s; }
    .view-all:hover { color: #fff; }

    .zones-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    /* КАРТОЧКА ЗОНЫ */
    .zone-card {
        background-color: #141414;
        border: 1px solid #222;
        border-radius: 16px;
        padding: 0; 
        overflow: hidden; 
        display: flex;
        flex-direction: column;
        transition: transform 0.3s, border-color 0.3s;
        cursor: pointer;
    }
    .zone-card:hover {
        transform: translateY(-5px);
        border-color: rgba(204, 255, 0, 0.5);
    }

    /*  ОБЕРТКА КАРТИНКИ */
    .zone-image-wrapper {
        height: 220px;
        position: relative;
        overflow: hidden;
        background-color: #1a1a1a;
    }

    /* Слой картинки */
    .zone-image-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        transition: transform 0.4s cubic-bezier(0.25, 1, 0.5, 1);

        pointer-events: none;
        user-select: none;
    }

    .zone-card:hover .zone-image-bg {
        transform: scale(1.08);
    }

    /* Градиент снизу картинки */
    .zone-image-wrapper::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 60%;
        background: linear-gradient(to top, #141414 0%, rgba(20, 20, 20, 0) 100%);
        pointer-events: none;
        z-index: 1;
    }

    /* Бейджи поверх картинки */
    .zone-badges {
        position: absolute;
        top: 15px;
        left: 15px;
        right: 15px;
        display: flex;
        justify-content: space-between;
        z-index: 2;
    }
    .badge-popular {
        background-color: #ccff00; 
        color: #000;
        padding: 5px 12px; 
        border-radius: 8px;
        font-size: 11px; 
        font-weight: 700;
    }
    .badge-platform {
        background-color: rgba(0,0,0,0.6); 
        backdrop-filter: blur(4px);
        color: #fff; 
        border: 1px solid rgba(255,255,255,0.15);
        padding: 5px 12px; 
        border-radius: 8px;
        font-size: 12px; 
        font-weight: 600;
    }

    /* ИНФОРМАЦИЯ ПОД КАРТИНКОЙ */
    .zone-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        padding: 20px; 
        flex: 1;
    }

    .zone-text-block {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .zone-title { 
        color: #fff; 
        font-size: 22px; 
        font-weight: 800; 
        margin: 0; 
    }
    .zone-meta { 
        color: #aaa; 
        font-size: 13px; 
        display: flex; 
        align-items: center; 
        gap: 6px; 
    }

    .zone-bottom-right {
        display: flex;
        align-items: flex-end;
        gap: 15px;
    }

    .zone-price { 
        color: #888; 
        font-size: 13px; 
        margin-bottom: 12px; 
    }
    
    .btn-arrow {
        width: 46px; 
        height: 46px;
        background-color: #ccff00; 
        color: #000;
        border-radius: 12px;
        display: flex; 
        align-items: center; 
        justify-content: center;
        text-decoration: none;
        transition: all 0.2s;
        flex-shrink: 0;
    }
    .btn-arrow:hover { 
        background-color: #fff; 
        transform: scale(1.05); 
    }
</style>

<!-- HERO SECTION -->
<div class="hero-section">
    <div class="badge-open">КЛУБ ОТКРЫТ 24/7</div>
    
    <h1 class="hero-title">
        ТВОЯ ИГРА.<br>
        <span>ТВОИ<br>ПРАВИЛА.</span>
    </h1>
    
    <p class="hero-desc">Мощное железо, профессиональные девайсы и атмосфера настоящего киберспорта.</p>
    
    <div class="hero-actions">
        <a href="{{ route('halls') }}" class="btn-primary">
            Забронировать место
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
        </a>
        <a href="{{ route('games') }}" class="btn-secondary">Каталог игр</a>
    </div>
    
    <div class="hero-features">
        <div class="feature-item">
            <span class="feature-title">PC</span>
            <span class="feature-subtitle">Игровые станции</span>
        </div>
        <div class="feature-item">
            <span class="feature-title">PS5 + VR</span>
            <span class="feature-subtitle">Консоли и VR</span>
        </div>
        <div class="feature-item">
            <span class="feature-title">24/7</span>
            <span class="feature-subtitle">Режим работы</span>
        </div>
    </div>
</div>

<!-- QUICK BOOKING BAR -->
<div class="quick-booking">
    <div class="qb-left">
        <div class="qb-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"></path></svg>
        </div>
        <div class="qb-text">
            <div class="title">Быстрое бронирование</div>
            <div class="subtitle">Найди свободное место за минуту</div>
        </div>
    </div>
    
    <div class="qb-info">
        <div class="qb-info-item">
            <span class="label">Клуб</span>
            <span class="value">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                Саратов, ул. Пушкина, д. колотушкина
            </span>
        </div>
        <div class="qb-info-item">
            <span class="label">Платформа</span>
            <span class="value">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 12h4m-2-2v4m7-1h.01M18 10h.01M4 6h16a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5l-2-2h-5l-2 2H4a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z"></path></svg>
                PC · Console · VR
            </span>
        </div>
        <div class="qb-info-item">
            <span class="label">Режим работы</span>
            <span class="value">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                Круглосуточно, 24/7
            </span>
        </div>
    </div>
    
    <a href="{{ route('booking') }}" class="btn-find-spot">Найти место</a>
</div>

<!-- ИГРОВЫЕ ЗОНЫ -->
<div class="zones-header">
    <div class="zones-header-left">
        <span class="badge">ВЫБЕРИ СВОЙ УРОВЕНЬ</span>
        <h2>Игровые зоны</h2>
    </div>
    <a href="{{ route('halls') }}" class="view-all">
        Смотреть все
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
    </a>
</div>

<div class="zones-grid">
    <!-- Зона 1: Cyber Arena -->
    <div class="zone-card">
        <div class="zone-image-wrapper">
            <div class="zone-image-bg" style="background-image: url('{{ asset('images/cyber-arena.jpg') }}');"></div>
            <div class="zone-badges">
                <span class="badge-popular">Популярное</span>
                <span class="badge-platform">PC</span>
            </div>
        </div>
        <div class="zone-content">
            <div class="zone-text-block">
                <h3 class="zone-title">Cyber Arena</h3>
                <div class="zone-meta">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    32 игровых места
                </div>
            </div>
            <div class="zone-bottom-right">
                <span class="zone-price">от 250 ₽/час</span>
                <a href="{{ route('booking') }}" class="btn-arrow">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Зона 2: Console Lounge -->
    <div class="zone-card">
        <div class="zone-image-wrapper">
            <div class="zone-image-bg" style="background-image: url('{{ asset('images/console-lounge.jpg') }}');"></div>
            <div class="zone-badges">
                <span class="badge-popular" style="visibility: hidden;">Популярное</span>
                <span class="badge-platform">PS5</span>
            </div>
        </div>
        <div class="zone-content">
            <div class="zone-text-block">
                <h3 class="zone-title">Console Lounge</h3>
                <div class="zone-meta">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    8 приватных зон
                </div>
            </div>
            <div class="zone-bottom-right">
                <span class="zone-price">от 350 ₽/час</span>
                <a href="{{ route('booking') }}" class="btn-arrow">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Зона 3: VR Lab -->
    <div class="zone-card">
        <div class="zone-image-wrapper">
            <div class="zone-image-bg" style="background-image: url('{{ asset('images/vr-lab.jpg') }}');"></div>
            <div class="zone-badges">
                <span class="badge-popular" style="visibility: hidden;">Популярное</span>
                <span class="badge-platform">VR</span>
            </div>
        </div>
        <div class="zone-content">
            <div class="zone-text-block">
                <h3 class="zone-title">VR Lab</h3>
                <div class="zone-meta">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    6 свободных VR-зон
                </div>
            </div>
            <div class="zone-bottom-right">
                <span class="zone-price">от 450 ₽/час</span>
                <a href="{{ route('booking') }}" class="btn-arrow">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection