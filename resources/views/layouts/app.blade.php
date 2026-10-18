<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC Club</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background-color: #0d0d0d;
            color: #e0e0e0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: grid;
            grid-template-columns: 260px 1fr; 
            grid-template-rows: 70px 1fr;     
            grid-template-areas: 
                "logo header"
                "sidebar main";
        }

        /* --- ЛОГОТИП --- */
        .logo-area {
            grid-area: logo; display: flex; align-items: center; padding-left: 28px;
            background-color: #0d0d0d; z-index: 10;
        }
        .logo-icon {
            background-color: #ccff00; color: #000; font-weight: 900; font-size: 25px;
            width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;
            border-radius: 12px 3px 12px 3px; margin-right: 5px;
        }
        .logo-text { font-size: 22px; font-weight: 800; letter-spacing: 1.5px; color: #fff; }

        /* --- ХЕДЕР --- */
        .header {
            grid-area: header; display: flex; align-items: center; padding: 0 30px;
            background-color: #0d0d0d; position: relative;
        }
        .header::after {
            content: ''; position: absolute; bottom: -1px; left: -260px;
            width: calc(100% + 260px); height: 1px; background-color: #333333; z-index: 1;
        }

        /* --- НАВИГАЦИЯ В ХЕДЕРЕ --- */
        .header-nav { display: flex; gap: 40px; height: 100%; margin-left: 20px; }
        .header-nav a {
            display: flex; align-items: center; color: #777777; text-decoration: none;
            font-weight: 500; font-size: 15px; position: relative; height: 100%;
        }
        .header-nav a:hover { color: #cccccc; }
        .header-nav a.active { color: #ffffff; }
        .header-nav a::after {
            content: ''; position: absolute; bottom: 0; left: 0; width: 100%; height: 2px;
            background-color: #ccff00; box-shadow: 0 0 10px #ccff00;
            border-radius: 2px 2px 0 0; transform: scaleX(0); transform-origin: center;
        }
        .header-nav a.active::after { animation: growLine 0.2s ease-out forwards; }
        @keyframes growLine { 0% { transform: scaleX(0); } 100% { transform: scaleX(1); } }

        /* --- КНОПКИ ДЕЙСТВИЙ В ХЕДЕРЕ --- */
        .header-actions { margin-left: auto; display: flex; gap: 15px; align-items: center; }
        .action-btn {
            width: 44px; height: 44px; border-radius: 12px; background-color: #1a1a1a;
            border: 1px solid #2a2a2a; display: flex; justify-content: center; align-items: center;
            cursor: pointer; position: relative; color: #fff; transition: all 0.2s ease;
        }
        .action-btn:hover { border-color: #ccff00; color: #ccff00; }
        .action-avatar {
            font-weight: 800; font-size: 14px; letter-spacing: 0.5px;
            background: linear-gradient(135deg, #444343 0%, #1a1a1a 100%);
            border: 1px solid #44444475;
        }
        .action-avatar:hover { border-color: #ccff00; color: #ccff00; }
        /* Стиль для кнопки неавторизованного пользователя */
        .action-btn.logged-out-profile {
            color: #ccff00;
            border-color: #ccff0050;
            background-color: rgba(204, 255, 0, 0.08);
        }
        .badge-count {
            position: absolute; top: -6px; right: -6px; background-color: #ccff00;
            color: #000; font-size: 10px; font-weight: 800; width: 18px; height: 18px;
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            border: 2px solid #0d0d0d;
        }

        /* --- БОКОВАЯ ПАНЕЛЬ --- */
        .sidebar {
            grid-area: sidebar; padding: 30px 20px; background-color: #0d0d0d;
            position: relative; display: flex; flex-direction: column;
        }
        .sidebar::after {
            content: ''; position: absolute; top: -70px; right: -1px;
            height: calc(100% + 70px); width: 1px; background-color: #333333; z-index: 1;
        }

        /* --- МЕНЮ В САЙДБАРЕ --- */
        .nav-title {
            color: #666; font-size: 11px; font-weight: 700; letter-spacing: 1.5px;
            margin-bottom: 15px; text-transform: uppercase;
        }
        .nav-list { list-style: none; }
        .nav-item { margin-bottom: 5px; }
        .nav-link {
            display: flex; align-items: center; padding: 12px 15px; color: #888;
            text-decoration: none; border-radius: 8px; transition: all 0.2s;
            font-weight: 500; font-size: 15px;
        }
        .nav-link:hover { color: #ccc; background-color: #1a1a1a; }
        .nav-link.active {
            color: #ccff00;
            background: linear-gradient(to right, rgba(204, 255, 0, 0.15) 0%, rgba(204, 255, 0, 0.01) 100%);
            border-left: 4px solid #ccff00; border-radius: 8px; padding-left: 11px; 
        }
        .nav-link svg { margin-right: 14px; opacity: 0.8; }
        .nav-link.active svg { opacity: 1; }

        /* --- НИЖНЯЯ ЧАСТЬ САЙДБАРА --- */
        .sidebar-bottom {
            margin-top: auto; /* Прижимает всё вниз */
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .back-link {
            padding: 12px 15px; color: #888; text-decoration: none;
            font-size: 14px; font-weight: 500; display: flex; align-items: center;
            transition: all 0.2s; cursor: pointer; border-radius: 8px;
        }
        .back-link:hover { color: #fff; background-color: #1a1a1a; }
        .back-link svg { margin-right: 14px; }

        /* --- ОСНОВНОЙ КОНТЕНТ --- */
        .main-content {
            grid-area: main; padding: 30px; overflow-y: auto; background-color: #0d0d0d;
        }


        /* Стиль для PNG иконки через маску */
        .game-png-icon {
            display: inline-block; /* Обязательно для span */
            width: 20px;
            height: 20px;
            margin-right: 14px;
            
            /* Базовый цвет (серый) */
            background-color: #888;
            
            /* Твой PNG как маска */
            mask-image: url("{{ asset('icons/gaming.png') }}");
            -webkit-mask-image: url("{{ asset('icons/gaming.png') }}");
            
            /* Настройки маски */
            mask-size: contain;
            -webkit-mask-size: contain;
            mask-repeat: no-repeat;
            -webkit-mask-repeat: no-repeat;
            mask-position: center;
            -webkit-mask-position: center;
            
            transition: background-color 0.2s;
        }

        /* При наведении - белый */
        .nav-link:hover .game-png-icon {
            background-color: #ccc;
        }

        /* Когда активно - зеленый */
        .nav-link.active .game-png-icon {
            background-color: #ccff00;
        }
    </style>
</head>
<body>

    <!-- Логотип -->
    <div class="logo-area">
        <div class="logo-icon">P</div>
        <div class="logo-text">CLUBE</div>
    </div>

    <!-- Хедер -->
    <header class="header">
        <nav class="header-nav">
            <a href="{{ route('start') }}" class="{{ request()->routeIs('start') ? 'active' : '' }}">Главная</a>
            <a href="{{ route('halls') }}" class="{{ request()->routeIs('halls') ? 'active' : '' }}">Залы</a>
            <a href="{{ route('booking') }}" class="{{ request()->routeIs('booking') ? 'active' : '' }}">Бронирование</a>
            <a href="{{ route('games') }}" class="{{ request()->routeIs('games') ? 'active' : '' }}">Игры</a>
        </nav>

        <div class="header-actions">
            <x-notifications-widget />
            <x-cart-widget />
            
            <!-- Кнопка профиля в хедере -->
            <div class="action-btn action-avatar" id="header-profile-btn" title="Профиль" onclick="handleProfileClick(event)">
                AK
            </div>
        </div>
    </header>

    <!-- Боковая панель -->
    <aside class="sidebar">
        <div class="nav-title">Навигация</div>
        <ul class="nav-list">
            <li class="nav-item">
                <a href="{{ route('start') }}" class="nav-link {{ request()->routeIs('start') ? 'active' : '' }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="2" ry="2"></rect><rect x="14" y="3" width="7" height="7" rx="2" ry="2"></rect><rect x="14" y="14" width="7" height="7" rx="2" ry="2"></rect><rect x="3" y="14" width="7" height="7" rx="2" ry="2"></rect></svg>
                    Главная
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('halls') }}" class="nav-link {{ request()->routeIs('halls') ? 'active' : '' }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                    Залы
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('booking') }}" class="nav-link {{ request()->routeIs('booking') ? 'active' : '' }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    Бронирование
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('games') }}" class="nav-link {{ request()->routeIs('games') ? 'active' : '' }}">
                    {{-- <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 12h4m-2-2v4m7-1h.01M18 10h.01M4 6h16a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5l-2-2h-5l-2 2H4a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z"></path></svg> --}}
                    <span class="game-png-icon"></span>
                    Игры
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('cabinet') }}" class="nav-link {{ request()->routeIs('cabinet') ? 'active' : '' }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    Кабинет
                </a>
            </li>
        </ul>

        <!-- Прижимаем низ сайдбара -->
        <div class="sidebar-bottom">
            <x-support-widget />
            
            <!-- Кнопка профиля в сайдбаре -->
            <a href="#" id="sidebar-profile-btn" class="back-link" onclick="handleProfileClick(event)">
                <span id="sidebar-profile-icon">
                    <!-- Иконка входа по умолчанию -->
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </span>
                <span id="sidebar-profile-text">Войти в профиль</span>
            </a>
        </div>
    </aside>

    <!-- Основной контент -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Компонент модального окна профиля -->
    <x-profile-modal />

    <!-- JS для управления авторизацией -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            updateAuthUI();
        });

        function isLoggedIn() {
            return localStorage.getItem('pc_logged_in') === 'true';
        }

        function updateAuthUI() {
            const loggedIn = isLoggedIn();
            const headerBtn = document.getElementById('header-profile-btn');
            const sidebarText = document.getElementById('sidebar-profile-text');
            const sidebarIcon = document.getElementById('sidebar-profile-icon');

            if (loggedIn) {
                // Состояние: ВОШЕЛ
                headerBtn.innerHTML = 'AK';
                headerBtn.classList.add('action-avatar');
                headerBtn.classList.remove('logged-out-profile'); // Убираем зеленый стиль
                
                sidebarText.innerText = 'Выйти';
                sidebarIcon.innerHTML = `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>`;
            } else {
                // Состояние: НЕ ВОШЕЛ
                headerBtn.innerHTML = `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>`;
                headerBtn.classList.remove('action-avatar');
                headerBtn.classList.add('logged-out-profile'); // Добавляем зеленый стиль

                sidebarText.innerText = 'Войти в профиль';
                sidebarIcon.innerHTML = `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>`;
            }
        }

        function handleProfileClick(event) {
            event.preventDefault();
            const isSidebar = event.currentTarget.id === 'sidebar-profile-btn';

            if (isLoggedIn()) {
                if (isSidebar) {
                    // Если вошли и нажали в сайдбаре - ВЫХОДИМ
                    localStorage.removeItem('pc_logged_in');
                    updateAuthUI();
                    // Если мы на странице кабинета, можно перекинуть на главную
                    if (window.location.pathname.includes('/cabinet')) {
                        window.location.href = "{{ route('start') }}";
                    }
                } else {
                    // Если вошли и нажали в хедере - идем в КАБИНЕТ
                    window.location.href = "{{ route('cabinet') }}";
                }
            } else {
                // Если НЕ вошли (неважно куда нажали) - открываем модалку
                openProfileModal();
            }
        }
    </script>
</body>
</html>