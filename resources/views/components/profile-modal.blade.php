<div class="profile-modal-overlay" id="profile-modal">
    <div class="profile-modal-content">
        <div class="profile-modal-header">
            <div>
                <div class="profile-modal-badge">ВХОД В PCLUBE</div>
                <h2 class="profile-modal-title">Выберите профиль</h2>
            </div>
            <button class="profile-modal-close" onclick="closeProfileModal()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <p class="profile-modal-desc">В демо-режиме можно войти под одной из трех ролей и проверить доступные функции.</p>

        <div class="profile-role-list">
            <!-- Пользователь -->
            <div class="profile-role-card" onclick="loginAs('user')">
                <div class="role-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </div>
                <div class="role-info">
                    <div class="role-title">Пользователь</div>
                    <div class="role-desc">Бронирования, платежи и уведомления</div>
                    <div class="role-perks">ЛИЧНЫЙ КАБИНЕТ</div>
                </div>
                <svg class="role-arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </div>

            <!-- Менеджер -->
            <div class="profile-role-card" onclick="loginAs('manager')">
                <div class="role-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <div class="role-info">
                    <div class="role-title">Менеджер</div>
                    <div class="role-desc">Управление залами и бронированиями</div>
                    <div class="role-perks">КАБИНЕТ + УПРАВЛЕНИЕ</div>
                </div>
                <svg class="role-arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </div>

            <!-- Администратор -->
            <div class="profile-role-card" onclick="loginAs('admin')">
                <div class="role-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                </div>
                <div class="role-info">
                    <div class="role-title">Администратор</div>
                    <div class="role-desc">Полный доступ и состояние системы</div>
                    <div class="role-perks">ВСЕ РАЗДЕЛЫ</div>
                </div>
                <svg class="role-arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </div>
        </div>
    </div>
</div>

@once
<style>
    .profile-modal-overlay {
        position: fixed; inset: 0; background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px);
        display: flex; justify-content: center; align-items: center;
        z-index: 3000; visibility: hidden; opacity: 0;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }
    .profile-modal-overlay.show { visibility: visible; opacity: 1; }

    .profile-modal-content {
        background: #141414; border: 1px solid #444; border-radius: 16px;
        width: 100%; max-width: 550px; padding: 30px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.8);
        transform: translateY(20px); transition: transform 0.3s ease;
    }
    .profile-modal-overlay.show .profile-modal-content { transform: translateY(0); }

    .profile-modal-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; }
    .profile-modal-badge { color: #ccff00; font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 8px; }
    .profile-modal-title { color: #fff; font-size: 26px; font-weight: 800; margin: 0; }
    .profile-modal-close {
        background: transparent; border: 1px solid #333; color: #888;
        width: 36px; height: 36px; border-radius: 8px; cursor: pointer;
        display: flex; align-items: center; justify-content: center; transition: all 0.2s;
    }
    .profile-modal-close:hover { background: #2a2a2a; color: #fff; border-color: #555; }

    .profile-modal-desc { color: #888; font-size: 14px; margin-bottom: 25px; line-height: 1.5; }

    .profile-role-list { display: flex; flex-direction: column; gap: 10px; }
    .profile-role-card {
        display: flex; align-items: center; gap: 15px;
        background: #1a1a1a; border: 1px solid #333; border-radius: 12px;
        padding: 15px 20px; cursor: pointer;
        transition: all 0.2s ease, transform 0.2s ease;
    }
    /* Эффект при наведении как на скриншоте */
    .profile-role-card:hover {
        border-color: #ccff00;
        background: linear-gradient(to right, rgba(204, 255, 0, 0.1) 0%, #1a1a1a 100%);
        transform: translateX(6px);
    }

    .role-icon {
        width: 44px; height: 44px; border-radius: 10px;
        background: rgba(204, 255, 0, 0.1); color: #ccff00;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .role-info { flex: 1; }
    .role-title { color: #fff; font-weight: 600; font-size: 16px; margin-bottom: 4px; }
    .role-desc { color: #888; font-size: 13px; margin-bottom: 6px; }
    .role-perks { color: #ccff00; font-size: 10px; font-weight: 700; letter-spacing: 1px; }
    
    .role-arrow { color: #fff; opacity: 0.5; transition: opacity 0.2s; }
    .profile-role-card:hover .role-arrow { opacity: 1; color: #ccff00; }
</style>

<script>
    function openProfileModal() {
        document.getElementById('profile-modal').classList.add('show');
    }
    function closeProfileModal() {
        document.getElementById('profile-modal').classList.remove('show');
    }
    function loginAs(role) {
        // Имитируем вход
        localStorage.setItem('pc_logged_in', 'true');
        // Перенаправляем в кабинет
        window.location.href = "{{ route('cabinet') }}";
    }
    document.getElementById('profile-modal').addEventListener('click', function(event) {
        if (event.target === this) closeProfileModal();
    });
</script>
@endonce