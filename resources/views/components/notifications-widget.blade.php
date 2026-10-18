<div>
    <!-- Кнопка уведомлений -->
    <div class="action-btn" title="Уведомления" onclick="openNotifications()">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
        </svg>
        <span class="badge-dot"></span>
    </div>

    <!-- Модальное окно уведомлений -->
    <div class="notification-overlay" id="notification-modal">
        <div class="notification-panel">
            <div class="notif-header">
                <div>
                    <div class="notif-badge">ЦЕНТР СОБЫТИЙ</div>
                    <div class="notif-title-wrap">
                        <h2 class="notif-title">Уведомления</h2>
                        <span class="notif-count">2</span>
                    </div>
                </div>
                <button class="notif-close" onclick="closeNotifications()">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <div class="notif-body">
                <!-- Уведомление 1 (Непрочитанное) -->
                <div class="notif-item unread">
                    <div class="notif-item-icon green">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </div>
                    <div class="notif-item-content">
                        <div class="notif-item-title">Бронирование подтверждено</div>
                        <div class="notif-item-desc">Pro Sector - место 07 - сегодня в 19:00</div>
                        <div class="notif-item-time">Только что</div>
                    </div>
                </div>

                <!-- Уведомление 2 (Непрочитанное) -->
                <div class="notif-item unread">
                    <div class="notif-item-icon green">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    </div>
                    <div class="notif-item-content">
                        <div class="notif-item-title">До начала сенса 2 часа</div>
                        <div class="notif-item-desc">Не забудьте документ для входа в клуб</div>
                        <div class="notif-item-time">Только что</div>
                    </div>
                </div>

                <!-- Уведомление 3 (Прочитанное) -->
                <div class="notif-item">
                    <div class="notif-item-icon gray">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 12h4m-2-2v4m7-1h.01M18 10h.01M4 6h16a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5l-2-2h-5l-2 2H4a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z"></path></svg>
                    </div>
                    <div class="notif-item-content">
                        <div class="notif-item-title">Новые игры в VR Lab</div>
                        <div class="notif-item-desc">Добавили Beat Saber и Half-Life: Alyx</div>
                        <div class="notif-item-time">Вчера</div>
                    </div>
                </div>
            </div>

            <div class="notif-footer">
                <a href="{{ route('cabinet', ['tab' => 'notifications']) }}" class="notif-btn">Все уведомления</a>
            </div>
        </div>
    </div>
</div>

@once
<style>
    /* Стили кнопки (копируем из app.blade.php, чтобы компонент был автономным) */
    .action-btn {
        width: 44px; height: 44px; border-radius: 12px;
        background-color: #1a1a1a; border: 1px solid #2a2a2a;
        display: flex; justify-content: center; align-items: center;
        cursor: pointer; position: relative; color: #fff;
        transition: all 0.2s ease;
    }
    .action-btn:hover { border-color: #ccff00; color: #ccff00; }
    .badge-dot {
        position: absolute; top: 8px; right: 8px; width: 8px; height: 8px;
        background-color: #ff3b30; border-radius: 50%; border: 2px solid #1a1a1a;
    }

    /* --- Стили модального окна --- */
    .notification-overlay {
        position: fixed; inset: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px);
        z-index: 1000; visibility: hidden; opacity: 0;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }
    .notification-overlay.show { visibility: visible; opacity: 1; }

    .notification-panel {
        position: fixed; top: 0; right: 0; height: 100vh; width: 420px; max-width: 100%;
        background: #141414; border-left: 1px solid #444;
        display: flex; flex-direction: column;
        transform: translateX(100%);
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: -10px 0 30px rgba(0, 0, 0, 0.5);
    }
    .notification-overlay.show .notification-panel { transform: translateX(0); }

    .notif-header {
        padding: 30px; display: flex; justify-content: space-between;
        align-items: flex-start; border-bottom: 1px solid #444;
    }
    .notif-badge {
        color: #ccff00; font-size: 11px; font-weight: 700;
        letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 8px;
    }
    .notif-title-wrap { display: flex; align-items: center; gap: 10px; }
    .notif-title { color: #fff; font-size: 26px; font-weight: 800; margin: 0; }
    .notif-count {
        background: #ccff00; color: #000; font-size: 13px; font-weight: 800;
        width: 24px; height: 24px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
    }
    .notif-close {
        background: transparent; border: 1px solid #333; color: #888;
        width: 36px; height: 36px; border-radius: 8px; cursor: pointer;
        display: flex; align-items: center; justify-content: center; transition: all 0.2s;
    }
    .notif-close:hover { background: #2a2a2a; color: #fff; border-color: #555; }

    .notif-body { flex: 1; overflow-y: auto; }
    .notif-item {
        display: flex; gap: 15px; padding: 20px 30px;
        border-bottom: 1px solid #444; transition: background 0.2s;
    }
    
    /* --- ГРАДИЕНТНОЕ СВЕЧЕНИЕ ДЛЯ НЕПРОЧИТАННЫХ --- */
    .notif-item.unread {
        background: linear-gradient(to right, rgba(204, 255, 0, 0.08) 0%, rgba(204, 255, 0, 0.0) 80%);
    }
    .notif-item.unread:hover {
        background: linear-gradient(to right, rgba(204, 255, 0, 0.12) 0%, rgba(204, 255, 0, 0.02) 80%);
    }
    
    .notif-item-icon {
        width: 44px; height: 44px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .notif-item-icon.green { 
        /* Также добавляем градиент на саму иконку */
        background: linear-gradient(135deg, rgba(204, 255, 0, 0.15) 10%, rgba(204, 255, 0, 0.15) 100%);
        color: #ccff00; 
    }
    .notif-item-icon.gray { background: #2a2a2a; color: #888; }
    
    .notif-item-content { display: flex; flex-direction: column; gap: 4px; }
    .notif-item-title { color: #fff; font-weight: 600; font-size: 15px; }
    .notif-item-desc { color: #888; font-size: 13px; }
    .notif-item-time { color: #555; font-size: 12px; margin-top: 4px; }

    .notif-footer { padding: 20px 30px; border-top: 1px solid #444; }
    .notif-btn {
        display: block; width: 100%; background: #2a2a2a; border: 1px solid #444;
        color: #fff; text-align: center; padding: 14px; border-radius: 10px;
        text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.2s;
    }
    .notif-btn:hover { background: #2a2a2a; border-color: #555; }
</style>

<script>
    function openNotifications() {
        document.getElementById('notification-modal').classList.add('show');
    }
    function closeNotifications() {
        document.getElementById('notification-modal').classList.remove('show');
    }
    document.getElementById('notification-modal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeNotifications();
        }
    });
</script>
@endonce