<div>
    <!-- Блок помощи в сайдбаре -->
    <div class="help-block">
        <div class="help-icon">
            <img src="{{ asset('icons/call-center.png') }}" alt="Поддержка" width="24" height="24">
        </div>
        <div class="help-title">Нужна помощь?</div>
        <div class="help-subtitle">Мы на связи 24/7</div>
        <button onclick="openModal()" class="help-btn">Написать нам</button>
    </div>

    <!-- Модальное окно -->
    <div class="modal-overlay" id="support-modal">
        <div class="modal-content">
            
            <!-- Состояние 1: Форма -->
            <div id="modal-form-state">
                <div class="modal-header">
                    <div>
                        <div class="modal-badge">ПОДДЕРЖКА 24/7</div>
                        <h2 class="modal-title">Написать нам</h2>
                    </div>
                    <button class="modal-close" onclick="closeModal()">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                
                <p class="modal-desc">Опишите вопрос — оператор клуба ответит в чате или свяжется по телефону.</p>
                
                <form onsubmit="submitModal(event)">
                    <div class="form-group">
                        <label>Тема</label>
                        <select class="form-control">
                            <option>Вопрос по бронированию</option>
                            <option>Оплата и возврат</option>
                            <option>Техническая помощь</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Сообщение</label>
                        <textarea class="form-control" placeholder="Например: хочу изменить время бронирования..."></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">
                        Отправить сообщение
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </button>
                </form>
            </div>

            <!-- Состояние 2: Успех -->
            <div id="modal-success-state" style="display: none;">
                <div class="modal-header">
                    <div>
                        <div class="modal-badge">ПОДДЕРЖКА 24/7</div>
                        <h2 class="modal-title">Сообщение отправлено</h2>
                    </div>
                    <button class="modal-close" onclick="closeModal()">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                
                <div class="success-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                </div>
                
                <p class="success-text">Оператор уже получил сообщение и ответит в течение нескольких минут.</p>
                
                <button class="success-btn" onclick="closeModal()">Готово</button>
            </div>

        </div>
    </div>
</div>

@once
<style>
    /* --- Стили блока помощи --- */
    .help-block {
        margin-top: auto;
        /* ИЗМЕНЕНО: угол 225deg (из правого верхнего в левый нижний) */
        /* Увеличена начальная прозрачность для более заметного свечения */
        background: linear-gradient(225deg, rgba(204, 255, 0, 0.15) 10%, rgba(204, 255, 0, 0.0) 50%);
        border: 1px solid rgba(204, 255, 0, 0.15);
        border-radius: 12px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        margin-bottom: 15px;
    }
    .help-icon { color: #ccff00; margin-bottom: 12px; }
    .help-title { color: #fff; font-weight: 700; font-size: 15px; margin-bottom: 5px; }
    .help-subtitle { color: #888; font-size: 13px; margin-bottom: 15px; }
    
    .help-btn {
        display: block; width: 100%; 
        background-color: rgba(204, 255, 0, 0.10);
        /* ИЗМЕНЕНО: явная обводка кнопки */
        border: none; 
        color: #ccff00;
        padding: 10px; border-radius: 8px; font-size: 13px; font-weight: 600;
        text-align: center; text-decoration: none; transition: all 0.2s;
        cursor: pointer; font-family: inherit;
    }
    .help-btn:hover {
        background-color: #ccff00; color: #000;
        box-shadow: 0 0 15px rgba(204, 255, 0, 0.3);
    }

    /* --- Стили модального окна --- */
    .modal-overlay {
        position: fixed; inset: 0;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        display: flex; justify-content: center; align-items: center;
        z-index: 1000;
        visibility: hidden; opacity: 0;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }
    .modal-overlay.show { visibility: visible; opacity: 1; }
    .modal-content {
        background: #141414; border: 1px solid #2a2a2a; border-radius: 16px;
        width: 100%; max-width: 550px; padding: 30px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.6);
        transform: translateY(20px); transition: transform 0.3s ease;
        position: relative;
    }
    .modal-overlay.show .modal-content { transform: translateY(0); }
    
    .modal-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px; }
    .modal-badge { color: #ccff00; font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 8px; }
    .modal-title { color: #fff; font-size: 28px; font-weight: 800; margin: 0; }
    .modal-close {
        background: transparent; border: 1px solid #333; color: #888;
        width: 36px; height: 36px; border-radius: 8px; cursor: pointer;
        display: flex; align-items: center; justify-content: center; transition: all 0.2s;
    }
    .modal-close:hover { background: #2a2a2a; color: #fff; border-color: #555; }
    .modal-desc { color: #888; font-size: 14px; margin-bottom: 25px; line-height: 1.5; }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; color: #666; font-size: 12px; font-weight: 600; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; }
    .form-control {
        width: 100%; background: #0d0d0d; border: 1px solid #333;
        color: #fff; padding: 14px 16px; border-radius: 10px;
        font-size: 14px; font-family: inherit; outline: none; transition: border-color 0.2s;
    }
    .form-control:focus { border-color: #ccff00; }
    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23888' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 15px center; cursor: pointer;
    }
    textarea.form-control { resize: vertical; min-height: 120px; }
    .submit-btn {
        width: 100%; background: #ccff00; color: #000; border: none;
        padding: 16px; border-radius: 10px; font-size: 16px; font-weight: 700;
        cursor: pointer; display: flex; align-items: center; justify-content: center;
        gap: 10px; transition: background 0.2s, transform 0.1s;
    }
    .submit-btn:hover { background: #b3e600; }
    .submit-btn:active { transform: scale(0.98); }
    
    /* --- Состояние успеха --- */
    #modal-success-state { text-align: center; }
    
    /* ИЗМЕНЕНО: Выравнивание шапки по левому краю, чтобы бейдж и заголовок совпадали */
    #modal-success-state .modal-header {
        text-align: left;
    }
    
    .success-icon {
        width: 80px; height: 80px; background: #ccff00; border-radius: 50%;
        display: flex; align-items: center; justify-content: center; margin: 30px auto; color: #000;
    }
    .success-text { color: #888; font-size: 15px; margin-bottom: 30px; }
    .success-btn {
        background: #ccff00; color: #000; border: none;
        padding: 14px 40px; border-radius: 10px; font-size: 16px; font-weight: 700;
        cursor: pointer; transition: background 0.2s;
    }
    .success-btn:hover { background: #b3e600; }
</style>

<script>
    function openModal() {
        const modal = document.getElementById('support-modal');
        modal.classList.add('show');
        document.getElementById('modal-form-state').style.display = 'block';
        document.getElementById('modal-success-state').style.display = 'none';
    }

    function closeModal() {
        document.getElementById('support-modal').classList.remove('show');
    }

    function submitModal(event) {
        event.preventDefault();
        document.getElementById('modal-form-state').style.display = 'none';
        document.getElementById('modal-success-state').style.display = 'block';
    }

    document.getElementById('support-modal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeModal();
        }
    });
</script>
@endonce