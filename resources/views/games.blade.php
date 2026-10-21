@extends('layouts.app')

@section('content')
<style>
    /* ... (Все твои существующие стили для шапки, поиска и сетки остаются здесь) ... */
    .games-header { margin-bottom: 30px; }
    .badge-library {
        display: inline-block; color: #ccff00; font-size: 11px; font-weight: 700;
        letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 10px;
    }
    .header-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
    .games-title { font-size: 36px; font-weight: 800; color: #fff; margin: 0; }
    
    .search-box {
        display: flex; align-items: center; background-color: #1a1a1a;
        border: 1px solid #333; border-radius: 10px; padding: 10px 15px;
        width: 300px; transition: border-color 0.2s;
    }
    .search-box:focus-within { border-color: #ccff00; }
    .search-box svg { color: #666; margin-right: 10px; }
    .search-box input {
        background: transparent; border: none; color: #fff;
        font-size: 14px; outline: none; width: 100%;
    }
    .search-box input::placeholder { color: #666; }
    .games-subtitle { color: #888; font-size: 15px; margin: 0; }

    .filter-tabs {
        display: inline-flex; gap: 5px; background-color: #1a1a1a;
        border: 1px solid #333; border-radius: 12px; padding: 5px; margin-bottom: 30px;
    }
    .filter-tabs button {
        background-color: transparent; border: none; color: #666;
        padding: 8px 20px; border-radius: 8px; font-size: 14px; font-weight: 500;
        cursor: pointer; transition: all 0.2s;
    }
    .filter-tabs button:hover { color: #ccc; }
    .filter-tabs button.active {
        background-color: #2a2a2a; color: #fff; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    }

    .games-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 20px;
    }

    /* Стиль для сообщения "Ничего не найдено" */
    .no-results {
        display: none;
        color: #888;
        font-size: 16px;
        grid-column: 1 / -1; /* Растягиваем на всю ширину сетки */
        text-align: center;
        padding: 40px 0;
    }
</style>

<div class="games-header">
    <div class="badge-library">БИБЛИОТЕКА</div>
    <div class="header-top">
        <h1 class="games-title">Каталог игр</h1>
        <div class="search-box">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <!-- Добавили id="search-input" -->
            <input type="text" id="search-input" placeholder="Найти игру...">
        </div>
    </div>
    <p class="games-subtitle">Выберите платформу — все игры уже установлены и готовы к запуску.</p>
</div>

<!-- Добавили id="filter-tabs" и data-filter к кнопкам -->
<div class="filter-tabs" id="filter-tabs">
    <button class="active" data-filter="all">Все платформы</button>
    <button data-filter="pc">PC</button>
    <button data-filter="console">Console</button>
    <button data-filter="vr">VR</button>
</div>

<!-- Добавили id="games-grid" -->
<div class="games-grid" id="games-grid">
    @foreach($games as $game)
        <x-game-card :game="$game" />
    @endforeach
    
    <!-- Блок, который покажется, если ничего не найдено -->
    <div class="no-results" id="no-results">
        По вашему запросу ничего не найдено 
        <span class="game-png-icon"></span>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('search-input');
        const filterButtons = document.querySelectorAll('#filter-tabs button');
        const gameCards = document.querySelectorAll('.game-card');
        const noResultsMsg = document.getElementById('no-results');

        let currentFilter = 'all';
        let searchQuery = '';

        // Главная функция фильтрации
        function filterGames() {
            let visibleCount = 0;

            gameCards.forEach(card => {
                const name = card.getAttribute('data-name');
                const category = card.getAttribute('data-category');

                // Проверка поиска (по названию)
                const matchesSearch = name.includes(searchQuery);

                // Проверка фильтра (по категории)
                let matchesFilter = false;
                
                if (currentFilter === 'all') {
                    matchesFilter = true;
                } else if (currentFilter === 'pc' && category.includes('pc')) {
                    matchesFilter = true;
                } else if (currentFilter === 'console' && (category.includes('ps5') || category.includes('xbox') || category.includes('console'))) {
                    matchesFilter = true;
                } else if (currentFilter === 'vr' && category.includes('vr')) {
                    matchesFilter = true;
                }

                // Если совпало и то, и другое - показываем, иначе скрываем
                if (matchesSearch && matchesFilter) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Показываем сообщение "Ничего не найдено", если visibleCount == 0
            if (visibleCount === 0) {
                noResultsMsg.style.display = 'block';
            } else {
                noResultsMsg.style.display = 'none';
            }
        }

        searchInput.addEventListener('input', (e) => {
            searchQuery = e.target.value.toLowerCase().trim();
            filterGames();
        });

        filterButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                
                filterButtons.forEach(b => b.classList.remove('active'));
                // Добавляем active текущей
                btn.classList.add('active');
                
                // Берем значение фильтра из data-атрибута
                currentFilter = btn.getAttribute('data-filter');
                filterGames();
            });
        });
    });
</script>
@endsection