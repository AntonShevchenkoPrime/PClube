@extends('layouts.app')

@section('content')
<style>
    /* --- Общие стили для карточек --- */
    .card {
        /* БЫЛО: #141414, СТАЛО: #1a1a1a (светлее, лучше видно на фоне #0d0d0d) */
        background-color: #1a1a1a; 
        /* БЫЛО: #222, СТАЛО: #2a2a2a (более заметная рамка) */
        border: 1px solid #44444475; 
        border-radius: 16px;
        padding: 24px;
    }

    /* --- Профиль (Верхняя карточка) --- */
    .profile-card {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .profile-info {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .avatar {
        width: 80px;
        height: 80px;
        /* БЫЛО: сплошной #1e1e1e, СТАЛО: градиент из левого верхнего угла в правый нижний */
        background: linear-gradient(135deg, #444343 0%, #1a1a1a 100%);
        border: 1px solid #444;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 800;
        color: #fff;
        letter-spacing: 1px;
    }

    .profile-text h1 {
        font-size: 26px;
        font-weight: 800;
        color: #fff;
        margin: 0 0 8px 0;
    }

    .profile-text .level {
        color: #ccff00;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .profile-text .contacts {
        color: #666;
        font-size: 14px;
    }

    .profile-balance {
        text-align: right;
        display: flex;
        align-items: center;
        gap: 30px;
    }

    .balance-info {
        text-align: right;
    }

    .balance-label {
        color: #666;
        font-size: 12px;
        margin-bottom: 5px;
    }

    .balance-value {
        font-size: 28px;
        font-weight: 800;
        color: #fff;
    }

    .balance-value span {
        color: #ccff00;
        font-size: 16px;
    }

    .settings-btn {
        background-color: #4443436d;
        border: 1px solid #444;
        color: #fff;
        padding: 12px 24px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .settings-btn:hover {
        background-color: #2a2a2a;
        border-color: #555;
    }

    /* --- Карточки статистики --- */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        background-color: rgba(204, 255, 0, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ccff00;
    }

    .stat-info .label {
        color: #666;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .stat-info .value {
        color: #fff;
        font-size: 22px;
        font-weight: 800;
    }

    /* --- Вкладки (Табы) --- */
    .tabs-nav {
        display: flex;
        gap: 30px;
        border-bottom: 1px solid #333;
        margin-bottom: 20px;
        position: relative;
    }

    .tab-link {
        color: #666;
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        padding-bottom: 15px;
        position: relative;
        cursor: pointer;
        transition: color 0.2s;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .tab-link:hover {
        color: #ccc;
    }

    .tab-link.active {
        color: #fff;
    }

    /* Анимация полоски как в хедере */
    .tab-link::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #ccff00;
        box-shadow: 0 0 10px #ccff00;
        border-radius: 2px 2px 0 0;
        transform: scaleX(0);
        transform-origin: center;
    }

    .tab-link.active::after {
        animation: growLine 0.2s ease-out forwards;
    }

    @keyframes growLine {
        0% { transform: scaleX(0); }
        100% { transform: scaleX(1); }
    }

    /* Бейдж уведомлений */
    .badge-notify {
        background-color: #ff3b30;
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* --- Контент вкладок --- */
    .tab-content {
        display: none; /* По умолчанию скрыто */
    }

    .tab-content.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* --- Таблицы --- */
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table th {
        text-align: left;
        color: #555;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 15px 20px;
        border-bottom: 1px solid #333;
    }

    .data-table td {
        padding: 20px;
        border-bottom: 1px solid #333;
        color: #ccc;
        font-size: 14px;
    }

    .data-table tr:last-child td {
        border-bottom: none;
    }

    .data-table tr:hover td {
        /* БЫЛО: #1a1a1a, СТАЛО: #252525 (чуть светлее нового фона карточки) */
        background-color: #252525; 
    }

    .data-table .primary-text {
        color: #fff;
        font-weight: 600;
    }

    /* Статусы */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-badge::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background-color: currentColor;
    }

    .status-green { color: #ccff00; background-color: rgba(204, 255, 0, 0.1); }
    .status-red { color: #ff453a; background-color: rgba(255, 69, 58, 0.1); }
    .status-orange { color: #ff9f0a; background-color: rgba(255, 159, 10, 0.1); }
    .status-blue { color: #0a84ff; background-color: rgba(10, 132, 255, 0.1); }
    .status-gray { color: #888; background-color: rgba(255, 255, 255, 0.05); }

    /* --- Уведомления --- */
    .notification-item {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        padding: 20px;
        border-bottom: 1px solid #333;
    }

    .notification-item:last-child {
        border-bottom: none;
    }

    .notify-icon {
        width: 40px;
        height: 40px;
        background-color: #1e1e1e;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #888;
        flex-shrink: 0;
    }

    .notification-item.unread .notify-icon {
        background-color: rgba(204, 255, 0, 0.1);
        color: #ccff00;
    }

    .notify-content .title {
        color: #fff;
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 5px;
    }

    .notification-item:not(.unread) .title {
        color: #fff;
        font-weight: 500;
    }

    .notify-content .time {
        color: #555;
        font-size: 13px;
    }

</style>

<!-- ======================= ПРОФИЛЬ ======================= -->
<div class="card profile-card">
    <div class="profile-info">
        <div class="avatar">АК</div>
        <div class="profile-text">
            <div class="level">УРОВЕНЬ 12</div>
            <h1>Алексей Крылов</h1>
            <div class="contacts">alexey.krylov@email.ru • +7 999 120-24-12</div>
        </div>
    </div>
    <div class="profile-balance">
        <div class="balance-info">
            <div class="balance-label">Бонусный баланс</div>
            <div class="balance-value">1240 <span>XP</span></div>
        </div>
        <button class="settings-btn">Настройки</button>
    </div>
</div>

<!-- ======================= СТАТИСТИКА ======================= -->
<div class="stats-grid">
    <div class="card stat-card">
        <div class="stat-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        </div>
        <div class="stat-info">
            <div class="label">Всего бронирований</div>
            <div class="value">24</div>
        </div>
    </div>
    <div class="card stat-card">
        <div class="stat-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
        </div>
        <div class="stat-info">
            <div class="label">Часов в игре</div>
            <div class="value">86</div>
        </div>
    </div>
    <div class="card stat-card">
        <div class="stat-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
        </div>
        <div class="stat-info">
            <div class="label">Любимая платформа</div>
            <div class="value">Pro Sector</div>
        </div>
    </div>
</div>

<!-- ======================= ВКЛАДКИ ======================= -->
<div class="tabs-nav">
    <div class="tab-link active" onclick="switchTab('bookings', this)">История бронирований</div>
    <div class="tab-link" onclick="switchTab('payments', this)">История платежей</div>
    <div class="tab-link" onclick="switchTab('notifications', this)">
        Уведомления <span class="badge-notify">3</span>
    </div>
</div>

<!-- ======================= КОНТЕНТ ВКЛАДОК ======================= -->

<!-- Вкладка 1: История бронирований -->
<div id="tab-bookings" class="tab-content active">
    <div class="card" style="padding: 0;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Номер</th>
                    <th>Дата и время</th>
                    <th>Зона / Место</th>
                    <th>Сумма</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="primary-text">#PC-240518</td>
                    <td>18 мая, 19:00</td>
                    <td>Cyber Arena · Место 12</td>
                    <td class="primary-text">1560 ₽</td>
                    <td><span class="status-badge status-gray">Завершено</span></td>
                </tr>
                <tr>
                    <td class="primary-text">#PC-240524</td>
                    <td>24 мая, 19:00</td>
                    <td>Pro Sector · Место 07</td>
                    <td class="primary-text">1820 ₽</td>
                    <td><span class="status-badge status-green">Подтверждено</span></td>
                </tr>
                <tr>
                    <td class="primary-text">#PC-240601</td>
                    <td>1 июня, 16:30</td>
                    <td>Console Lounge · PS5-03</td>
                    <td class="primary-text">1050 ₽</td>
                    <td><span class="status-badge status-orange">Ожидает оплаты</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Вкладка 2: История платежей -->
<div id="tab-payments" class="tab-content">
    <div class="card" style="padding: 0;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Номер</th>
                    <th>Дата и время</th>
                    <th>Зона / Место</th>
                    <th>Сумма</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="primary-text">PAY-10842</td>
                    <td>24 мая, 19:00</td>
                    <td>Pro Sector · Место 07</td>
                    <td class="primary-text">1820 ₽</td>
                    <td><span class="status-badge status-green">Успешно</span></td>
                </tr>
                <tr>
                    <td class="primary-text">PAY-10796</td>
                    <td>18 мая, 19:00</td>
                    <td>Cyber Arena · Место 12</td>
                    <td class="primary-text">1560 ₽</td>
                    <td><span class="status-badge status-blue">Возврат</span></td>
                </tr>
                <tr>
                    <td class="primary-text">PAY-10901</td>
                    <td>1 июня, 16:30</td>
                    <td>Console Lounge · PS5-03</td>
                    <td class="primary-text">1050 ₽</td>
                    <td><span class="status-badge status-orange">Ожидает</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Вкладка 3: Уведомления -->
<div id="tab-notifications" class="tab-content">
    <div class="card" style="padding: 0;">
        <div class="notification-item unread">
            <div class="notify-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
            </div>
            <div class="notify-content">
                <div class="title">Бронирование #PC-240524 подтверждено</div>
                <div class="time">1 ч. назад</div>
            </div>
        </div>
        <div class="notification-item">
            <div class="notify-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div class="notify-content">
                <div class="title">Начислено 156 бонусных XP</div>
                <div class="time">2 ч. назад</div>
            </div>
        </div>
        <div class="notification-item">
            <div class="notify-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 12h4m-2-2v4m7-1h.01M18 10h.01M4 6h16a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5l-2-2h-5l-2 2H4a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z"></path></svg>
            </div>
            <div class="notify-content">
                <div class="title">Турнир по CS2 уже в эту субботу</div>
                <div class="time">3 ч. назад</div>
            </div>
        </div>
    </div>
</div>

<script>
    function switchTab(tabId, element) {
        // 1. Скрываем все вкладки
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.remove('active');
        });
        
        // 2. Убираем класс active у всех кнопок
        document.querySelectorAll('.tab-link').forEach(link => {
            link.classList.remove('active');
        });

        // 3. Показываем нужную вкладку
        document.getElementById('tab-' + tabId).classList.add('active');
        
        // 4. Добавляем класс active нажатой кнопке (запускает анимацию линии)
        element.classList.add('active');
    }

    // Проверяем URL при загрузке страницы
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const tab = urlParams.get('tab');
        if (tab === 'notifications') {
            // Находим ссылку на вкладку уведомлений и кликаем по ней программно
            const notifyTab = document.querySelector('.tab-link[onclick*="notifications"]');
            if (notifyTab) {
                switchTab('notifications', notifyTab);
            }
        }
    });
</script>

@endsection