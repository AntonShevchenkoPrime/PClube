<div>
    <!-- Кнопка корзины в хедере -->
    <div class="action-btn" title="Корзина" onclick="openCart()">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="9" cy="21" r="1"></circle>
            <circle cx="20" cy="21" r="1"></circle>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
        </svg>
        <span class="badge-count">2</span>
    </div>

    <!-- ========================================= -->
    <!-- 1. ВЫЕЗЖАЮЩАЯ КОРЗИНА -->
    <!-- ========================================= -->
    <div class="cart-overlay" id="cart-modal">
        <div class="cart-panel">
            <div class="cart-header">
                <div>
                    <div class="cart-badge">ВАШ ЗАКАЗ</div>
                    <div class="cart-title-wrap">
                        <h2 class="cart-title">Корзина</h2>
                        <span class="cart-count">2</span>
                    </div>
                </div>
                <button class="cart-close" onclick="closeCart()">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <div class="cart-body">
                <!-- Элемент 1 -->
                <div class="cart-item">
                    <div class="cart-item-image" style="background: linear-gradient(135deg, #1a0b2e 0%, #0d0d0d 100%);">
                        <span style="color: #ccff00; font-weight: 800; font-size: 14px;">Cyber<br>Arena</span>
                    </div>
                    <div class="cart-item-info">
                        <div class="cart-item-subtitle">БРОНИРОВАНИЕ</div>
                        <div class="cart-item-title">Cyber Arena · #12</div>
                        <div class="cart-item-meta">📅 24 мая, 19:00 — 22:00</div>
                    </div>
                </div>

                <!-- Элемент 2 -->
                <div class="cart-item-row">
                    <div>
                        <div class="cart-item-title">Игровое место</div>
                        <div class="cart-item-meta">Premium PC · 3 часа</div>
                    </div>
                    <div class="cart-item-price">1 170 ₽</div>
                </div>

                <!-- Элемент 3 -->
                <div class="cart-item-row">
                    <div>
                        <div class="cart-item-title">Gaming-набор</div>
                        <div class="cart-item-meta">Напиток + снек</div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <div class="cart-qty">
                            <button>−</button>
                            <span>1</span>
                            <button>+</button>
                        </div>
                        <div class="cart-item-price">390 ₽</div>
                    </div>
                </div>

                <div class="cart-promo">
                    <span>+</span> Добавить промокод
                </div>
            </div>

            <div class="cart-footer">
                <div class="cart-summary">
                    <div class="summary-row"><span>Подытог</span><span>1560 ₽</span></div>
                    <div class="summary-row"><span>Сервисный сбор</span><span>0 ₽</span></div>
                    <div class="summary-row total"><span>Итого</span><span>1560 ₽</span></div>
                </div>
                <button class="cart-checkout-btn" onclick="openPayment()">
                    Перейти к оплате
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </button>
                <div class="cart-security">🛡️ Безопасная оплата через защищенный шлюз</div>
            </div>
        </div>
    </div>

    <!-- ========================================= -->
    <!-- 2. МОДАЛЬНОЕ ОКНО ОПЛАТЫ (ЦЕНТР ЭКРАНА) -->
    <!-- ========================================= -->
    <div class="payment-overlay" id="payment-modal">
        <div class="payment-modal-content">
            
            <!-- Состояние 2.1: Форма оплаты -->
            <div id="payment-form-state">
                <div class="payment-header">
                    <div>
                        <div class="payment-badge">БЕЗОПАСНАЯ ОПЛАТА</div>
                        <h2 class="payment-title">Оплата заказа</h2>
                    </div>
                    <button class="payment-close" onclick="closePayment()">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <div class="payment-summary-box">
                    <span>Бронирование #PC-240524</span>
                    <span class="price">1560 ₽</span>
                </div>

                <form onsubmit="processPayment(event)">
                    <div class="form-group">
                        <label>Номер карты</label>
                        <div class="input-with-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                            <input type="text" class="form-control" value="4242 4242 4242 4242" placeholder="0000 0000 0000 0000">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Срок действия</label>
                            <input type="text" class="form-control" value="12 / 28" placeholder="ММ / ГГ">
                        </div>
                        <div class="form-group">
                            <label>CVV</label>
                            <input type="password" class="form-control" value="•••" placeholder="•••">
                        </div>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" id="save-card" checked>
                        <label for="save-card">Сохранить карту для будущих оплат</label>
                    </div>
                    <button type="submit" class="pay-btn">Оплатить 1560 ₽</button>
                </form>
                <div class="payment-footer-link">Имитировать отклонение</div>
                <div class="payment-security">🛡️ Данные защищены по стандарту PCI DSS</div>
            </div>

            <!-- Состояние 2.2: Обработка платежа -->
            <div id="payment-processing-state" style="display: none;">
                <div class="processing-icon">
                    <div class="spinner"></div>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ccff00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                </div>
                <div class="processing-badge">ОБРАБОТКА ПЛАТЕЖА</div>
                <h2 class="processing-title">Ожидаем подтверждение</h2>
                <p class="processing-desc">Не закрывайте окно. Обычно это занимает несколько секунд</p>
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
                <div class="payment-footer-link" onclick="closePayment()">Имитировать ошибку</div>
            </div>

            <!-- Состояние 2.3: Успех -->
            <div id="payment-success-state" style="display: none;">
                <div class="success-icon-large">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                </div>
                <div class="success-badge">ГОТОВО</div>
                <h2 class="success-title">Оплата успешно выполнена</h2>
                <p class="success-desc">Бронирование #PC-240524 подтверждено. Чек отправлен на вашу почту.</p>
                
                <div class="success-details">
                    <div class="detail-row"><span>Сумма оплаты</span><span>1560 ₽</span></div>
                    <div class="detail-row"><span>Дата и время</span><span>24 мая, 21:46</span></div>
                </div>

                <a href="{{ route('cabinet') }}" class="success-btn">
                    Перейти в личный кабинет
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            </div>

        </div>
    </div>
</div>

@once
<style>
    /* --- Стили кнопки в хедере --- */
    .action-btn {
        width: 44px; height: 44px; border-radius: 12px;
        background-color: #1a1a1a; border: 1px solid #2a2a2a;
        display: flex; justify-content: center; align-items: center;
        cursor: pointer; position: relative; color: #fff;
        transition: all 0.2s ease;
    }
    .action-btn:hover { border-color: #ccff00; color: #ccff00; }
    .badge-count {
        position: absolute; top: -6px; right: -6px;
        background-color: #ccff00; color: #000;
        font-size: 10px; font-weight: 800;
        width: 18px; height: 18px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        border: 2px solid #0d0d0d;
    }

    /* ========================================= */
    /* 1. ВЫЕЗЖАЮЩАЯ КОРЗИНА */
    /* ========================================= */
    .cart-overlay {
        position: fixed; inset: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px);
        z-index: 1000; visibility: hidden; opacity: 0;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }
    .cart-overlay.show { visibility: visible; opacity: 1; }

    .cart-panel {
        position: fixed; top: 0; right: 0; height: 100vh; width: 480px; max-width: 100%;
        background: #141414; border-left: 1px solid #444;
        display: flex; flex-direction: column;
        transform: translateX(100%);
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: -10px 0 30px rgba(0, 0, 0, 0.5);
    }
    .cart-overlay.show .cart-panel { transform: translateX(0); }

    .cart-header {
        padding: 30px; display: flex; justify-content: space-between;
        align-items: flex-start; border-bottom: 1px solid #444;
    }
    .cart-badge { color: #ccff00; font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 8px; }
    .cart-title-wrap { display: flex; align-items: center; gap: 10px; }
    .cart-title { color: #fff; font-size: 26px; font-weight: 800; margin: 0; }
    .cart-count {
        background: #ccff00; color: #000; font-size: 13px; font-weight: 800;
        width: 24px; height: 24px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
    }
    .cart-close {
        background: transparent; border: 1px solid #333; color: #888;
        width: 36px; height: 36px; border-radius: 8px; cursor: pointer;
        display: flex; align-items: center; justify-content: center; transition: all 0.2s;
    }
    .cart-close:hover { background: #2a2a2a; color: #fff; border-color: #555; }

    .cart-body { flex: 1; overflow-y: auto; padding: 0 30px; }
    
    .cart-item {
        display: flex; gap: 15px; padding: 20px 0;
        border-bottom: 1px solid #2a2a2a;
    }
    .cart-item-image {
        width: 60px; height: 60px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        text-align: center; flex-shrink: 0;
    }
    .cart-item-subtitle { color: #ccff00; font-size: 10px; font-weight: 700; letter-spacing: 1px; margin-bottom: 4px; }
    .cart-item-title { color: #fff; font-weight: 600; font-size: 15px; }
    .cart-item-meta { color: #666; font-size: 13px; margin-top: 4px; }
    
    .cart-item-row {
        display: flex; justify-content: space-between; align-items: center;
        padding: 20px 0; border-bottom: 1px solid #2a2a2a;
    }
    .cart-item-price { color: #fff; font-weight: 600; font-size: 15px; }

    .cart-qty {
        display: flex; align-items: center; gap: 10px;
        background: #1a1a1a; border: 1px solid #333;
        border-radius: 8px; padding: 4px 8px;
    }
    .cart-qty button {
        background: transparent; border: none; color: #888;
        font-size: 16px; cursor: pointer; padding: 0 4px;
    }
    .cart-qty button:hover { color: #fff; }
    .cart-qty span { color: #fff; font-weight: 600; font-size: 14px; }

    .cart-promo {
        color: #ccff00; font-weight: 600; font-size: 14px;
        padding: 20px 0; cursor: pointer; display: flex; align-items: center; gap: 8px;
    }
    .cart-promo span { font-size: 18px; font-weight: 400; }

    .cart-footer {
        padding: 20px 30px 30px; border-top: 1px solid #444;
        background: #141414;
    }
    .cart-summary { margin-bottom: 20px; }
    .summary-row {
        display: flex; justify-content: space-between;
        color: #888; font-size: 14px; margin-bottom: 10px;
    }
    .summary-row.total {
        color: #fff; font-size: 20px; font-weight: 800;
        margin-top: 15px; padding-top: 15px; border-top: 1px solid #2a2a2a;
    }
    .summary-row.total span:last-child { color: #fff; }

    .cart-checkout-btn {
        width: 100%; background: #ccff00; color: #000; border: none;
        padding: 18px; border-radius: 12px; font-size: 16px; font-weight: 700;
        cursor: pointer; display: flex; align-items: center; justify-content: center;
        gap: 10px; transition: background 0.2s;
    }
    .cart-checkout-btn:hover { background: #b3e600; }
    .cart-security {
        text-align: center; color: #555; font-size: 12px; margin-top: 15px;
    }

    /* ========================================= */
    /* 2. МОДАЛЬНОЕ ОКНО ОПЛАТЫ (ЦЕНТР ЭКРАНА) */
    /* ========================================= */
    .payment-overlay {
        position: fixed; inset: 0;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px);
        display: flex; justify-content: center; align-items: center;
        z-index: 2000; visibility: hidden; opacity: 0;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }
    .payment-overlay.show { visibility: visible; opacity: 1; }

    .payment-modal-content {
        background: #141414; border: 1px solid #444; border-radius: 16px;
        width: 100%; max-width: 500px; padding: 30px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.8);
        transform: translateY(20px); transition: transform 0.3s ease;
        position: relative;
    }
    .payment-overlay.show .payment-modal-content { transform: translateY(0); }

    /* Шапка */
    .payment-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 25px; }
    .payment-badge { color: #ccff00; font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 8px; }
    .payment-title { color: #fff; font-size: 26px; font-weight: 800; margin: 0; }
    .payment-close {
        background: transparent; border: 1px solid #333; color: #888;
        width: 36px; height: 36px; border-radius: 8px; cursor: pointer;
        display: flex; align-items: center; justify-content: center; transition: all 0.2s;
    }
    .payment-close:hover { background: #2a2a2a; color: #fff; border-color: #555; }

    /* Форма */
    .payment-summary-box {
        display: flex; justify-content: space-between; align-items: center;
        background: #1a1a1a; border: 1px solid #333; border-radius: 10px;
        padding: 16px 20px; margin-bottom: 25px;
    }
    .payment-summary-box .price { color: #fff; font-weight: 700; font-size: 18px; }

    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; color: #666; font-size: 12px; font-weight: 600; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; }
    .form-control {
        width: 100%; background: #0d0d0d; border: 1px solid #333;
        color: #fff; padding: 14px 16px; border-radius: 10px;
        font-size: 14px; font-family: inherit; outline: none; transition: border-color 0.2s;
    }
    .form-control:focus { border-color: #ccff00; }
    
    .input-with-icon {
        position: relative; display: flex; align-items: center;
    }
    .input-with-icon svg { position: absolute; left: 15px; }
    .input-with-icon input { padding-left: 45px; }

    .form-row { display: flex; gap: 15px; }
    .form-row .form-group { flex: 1; }

    .checkbox-group {
        display: flex; align-items: center; gap: 10px;
        margin-bottom: 25px; margin-top: -5px;
    }
    .checkbox-group input[type="checkbox"] {
        width: 18px; height: 18px; accent-color: #ccff00; cursor: pointer;
    }
    .checkbox-group label { color: #ccc; font-size: 13px; cursor: pointer; }

    .pay-btn {
        width: 100%; background: #ccff00; color: #000; border: none;
        padding: 18px; border-radius: 12px; font-size: 16px; font-weight: 700;
        cursor: pointer; transition: background 0.2s;
    }
    .pay-btn:hover { background: #b3e600; }

    .payment-footer-link {
        text-align: center; color: #666; font-size: 13px;
        text-decoration: underline; margin-top: 15px; cursor: pointer;
        transition: color 0.2s;
    }
    .payment-footer-link:hover { color: #ff453a; }
    .payment-security {
        text-align: center; color: #444; font-size: 12px; margin-top: 20px;
    }

    /* Состояние обработки */
    #payment-processing-state { text-align: center; padding: 20px 0; }
    .processing-icon {
        position: relative; width: 80px; height: 80px;
        margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;
    }
    .spinner {
        position: absolute; inset: 0;
        border: 3px solid rgba(204, 255, 0, 0.1);
        border-top-color: #ccff00;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    @keyframes spin { 100% { transform: rotate(360deg); } }
    
    .processing-badge { color: #ccff00; font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 10px; }
    .processing-title { color: #fff; font-size: 24px; font-weight: 800; margin-bottom: 10px; }
    .processing-desc { color: #888; font-size: 14px; margin-bottom: 30px; }

    .progress-bar {
        width: 100%; height: 4px; background: #2a2a2a;
        border-radius: 2px; overflow: hidden; margin-bottom: 25px;
    }
    .progress-fill {
        height: 100%; width: 0%; background: #ccff00;
        border-radius: 2px; animation: fillProgress 4s ease-in-out forwards;
    }
    @keyframes fillProgress { 100% { width: 100%; } }

    /* Состояние успеха */
    #payment-success-state { text-align: center; padding: 20px 0; }
    .success-icon-large {
        width: 80px; height: 80px; background: #ccff00; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px; box-shadow: 0 0 20px rgba(204, 255, 0, 0.4);
    }
    .success-badge { color: #ccff00; font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 10px; }
    .success-title { color: #fff; font-size: 24px; font-weight: 800; margin-bottom: 15px; }
    .success-desc { color: #888; font-size: 14px; margin-bottom: 25px; line-height: 1.5; }

    .success-details {
        background: #1a1a1a; border: 1px solid #333; border-radius: 10px;
        padding: 20px; margin-bottom: 25px; text-align: left;
    }
    .detail-row {
        display: flex; justify-content: space-between;
        color: #888; font-size: 14px; margin-bottom: 10px;
    }
    .detail-row:last-child { margin-bottom: 0; }
    .detail-row span:last-child { color: #fff; font-weight: 600; }

    .success-btn {
        display: inline-flex; align-items: center; justify-content: center; gap: 10px;
        width: 100%; background: #ccff00; color: #000; border: none;
        padding: 18px; border-radius: 12px; font-size: 16px; font-weight: 700;
        text-decoration: none; transition: background 0.2s;
    }
    .success-btn:hover { background: #b3e600; }
</style>

<script>
    // --- Корзина ---
    function openCart() {
        document.getElementById('cart-modal').classList.add('show');
    }
    function closeCart() {
        document.getElementById('cart-modal').classList.remove('show');
    }
    document.getElementById('cart-modal').addEventListener('click', function(event) {
        if (event.target === this) closeCart();
    });

    // --- Оплата ---
    function openPayment() {
        // Сначала закрываем корзину
        closeCart();
        // Открываем модальное окно оплаты
        document.getElementById('payment-modal').classList.add('show');
        
        // Сбрасываем состояния
        document.getElementById('payment-form-state').style.display = 'block';
        document.getElementById('payment-processing-state').style.display = 'none';
        document.getElementById('payment-success-state').style.display = 'none';
    }
    function closePayment() {
        document.getElementById('payment-modal').classList.remove('show');
    }
    document.getElementById('payment-modal').addEventListener('click', function(event) {
        if (event.target === this) closePayment();
    });

    function processPayment(event) {
        event.preventDefault(); // Отменяем отправку формы
        
        // Показываем состояние обработки
        document.getElementById('payment-form-state').style.display = 'none';
        document.getElementById('payment-processing-state').style.display = 'block';
        
        // Имитируем задержку обработки (4 секунды)
        setTimeout(() => {
            document.getElementById('payment-processing-state').style.display = 'none';
            document.getElementById('payment-success-state').style.display = 'block';
        }, 4000);
    }
</script>
@endonce