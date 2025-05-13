<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Cart;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = 'Заказ #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Мои заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// Подключаем стили и скрипты
$this->registerCssFile('https://fonts.googleapis.com/css2?family=Caveat:wght@400;700&family=Marck+Script&family=Montserrat:wght@300;400;600&display=swap');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
?>

<style>
    :root {
        --main-color: #7D6B5E;
        --secondary-color: #5a3e36;
        --accent-color: #d4a373;
        --light-bg: #fffaf0;
        --text-color: #5a3e36;
        --shadow: 0 4px 20px rgba(139, 94, 60, 0.15);
        --border-radius: 15px;
        --transition: all 0.3s ease;
    }
    
    body {
        font-family: 'Montserrat', sans-serif;
        background-color: var(--light-bg);
        color: var(--text-color);
    }
    
    .order-detail-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }
    
    .page-title {
        font-family: 'Marck Script', cursive;
        font-size: 2.5rem;
        color: var(--main-color);
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
    }
    
    .page-title::after {
        content: '';
        display: block;
        width: 150px;
        height: 3px;
        background: linear-gradient(90deg, var(--main-color), var(--accent-color));
        margin: 0.5rem auto 0;
    }
    
    .order-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        margin-bottom: 2rem;
        overflow: hidden;
        transform: translateY(20px);
        opacity: 0;
        animation: fadeInUp 0.5s forwards;
    }
    
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .order-header {
        background: linear-gradient(135deg, var(--main-color), var(--secondary-color));
        color: white;
        padding: 1.5rem;
        position: relative;
    }
    
    .order-status {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        background: rgba(255,255,255,0.2);
        margin-top: 0.5rem;
    }
    
    .order-body {
        padding: 2rem;
    }
    
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }
    
    .detail-item {
        margin-bottom: 1rem;
    }
    
    .detail-label {
        font-size: 0.85rem;
        color: var(--secondary-color);
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }
    
    .detail-label i {
        margin-right: 0.5rem;
        color: var(--accent-color);
    }
    
    .detail-value {
        font-size: 1.1rem;
        color: var(--text-color);
    }
    
    .products-title {
        font-family: 'Marck Script', cursive;
        font-size: 1.8rem;
        color: var(--main-color);
        margin: 2rem 0 1.5rem;
        position: relative;
        text-align: center;
    }
    
    .products-title::after {
        content: '';
        display: block;
        width: 100px;
        height: 2px;
        background: var(--accent-color);
        margin: 0.5rem auto 0;
    }
    
    .product-list {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        overflow: hidden;
    }
    
    .product-item {
        display: flex;
        align-items: center;
        padding: 1.5rem;
        border-bottom: 1px dashed rgba(139, 94, 60, 0.2);
        transition: var(--transition);
    }
    
    .product-item:last-child {
        border-bottom: none;
    }
    
    .product-item:hover {
        background: rgba(212, 163, 115, 0.05);
    }
    
    .product-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
        margin-right: 1.5rem;
        border: 1px solid rgba(139, 94, 60, 0.1);
    }
    
    .product-info {
        flex: 1;
    }
    
    .product-name {
        font-family: 'Caveat', cursive;
        font-size: 1.5rem;
        color: var(--main-color);
        margin-bottom: 0.5rem;
    }
    
    .product-price {
        font-size: 1.2rem;
        color: var(--secondary-color);
        font-weight: 600;
    }
    
    .product-quantity {
        color: #666;
        font-size: 0.9rem;
    }
    
    .product-total {
        font-weight: 600;
        color: var(--text-color);
        min-width: 100px;
        text-align: right;
    }
    
    .order-summary {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        padding: 1.5rem;
        margin-top: 2rem;
    }
    
    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 0.8rem 0;
        border-bottom: 1px dashed rgba(139, 94, 60, 0.2);
    }
    
    .summary-row:last-child {
        border-bottom: none;
        font-weight: 700;
        font-size: 1.3rem;
        color: var(--main-color);
        padding-top: 1rem;
        margin-top: 1rem;
    }
    
    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        margin-top: 2rem;
    }
    
    .action-btn {
        padding: 0.8rem 2rem;
        border-radius: 30px;
        font-family: 'Caveat', cursive;
        font-size: 1.3rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: var(--transition);
    }
    
    .back-btn {
        background: white;
        color: var(--main-color);
        border: 2px solid var(--main-color);
    }
    
    .back-btn:hover {
        background: rgba(139, 94, 60, 0.1);
        transform: translateY(-2px);
    }
    
    .update-btn {
        background: var(--main-color);
        color: white;
        border: 2px solid var(--main-color);
    }
    
    .update-btn:hover {
        background: var(--secondary-color);
        border-color: var(--secondary-color);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(139, 94, 60, 0.2);
    }
    
    .delete-btn {
        background: white;
        color: #dc3545;
        border: 2px solid #dc3545;
    }
    
    .delete-btn:hover {
        background: #dc3545;
        color: white;
        transform: translateY(-2px);
    }
    
    /* Анимации */
    .product-item {
        opacity: 0;
        transform: translateX(-20px);
        animation: fadeInRight 0.5s forwards;
    }
    
    @keyframes fadeInRight {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    /* Задержки для анимации товаров */
    .product-item:nth-child(1) { animation-delay: 0.1s; }
    .product-item:nth-child(2) { animation-delay: 0.2s; }
    .product-item:nth-child(3) { animation-delay: 0.3s; }
    .product-item:nth-child(4) { animation-delay: 0.4s; }
    .product-item:nth-child(5) { animation-delay: 0.5s; }
</style>

<div class="order-detail-container">
    <h1 class="page-title animate__animated animate__fadeIn"><?= Html::encode($this->title) ?></h1>

    <div class="order-card" style="animation-delay: 0.1s">
        <div class="order-header">
            <div style="color: white; font-size: 1.3rem; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <i class="fas fa-calendar-alt"></i> <?= Yii::$app->formatter->asDate($model->date, 'long') ?>
                </div>
                <div class="order-status animate__animated animate__pulse animate__infinite">
                    <?= $model->status->name ?>
                </div>
            </div>
        </div>
        
        <div class="order-body">
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label"><i class="fas fa-user"></i> Клиент</div>
                    <div class="detail-value"><?= $model->user->username ?></div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label"><i class="fas fa-map-marker-alt"></i> Адрес доставки</div>
                    <div class="detail-value"><?= $model->adress ?></div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label"><i class="fas fa-credit-card"></i> Способ оплаты</div>
                    <div class="detail-value"><?= $model->payment_method ?></div>
                </div>
            </div>
        </div>
    </div>
    
    <h2 class="products-title">Товары в заказе</h2>
    
    <div class="product-list">
        <?php foreach ($model->carts as $index => $cartItem): ?>
            <div class="product-item" style="animation-delay: <?= ($index + 1) * 0.1 ?>s">
                <?= Html::img('@web/' . $cartItem->product->photo, [
                    'class' => 'product-image',
                    'alt' => $cartItem->product->name
                ]) ?>
                
                <div class="product-info">
                    <div class="product-name"><?= Html::encode($cartItem->product->name) ?></div>
                    <div class="product-price"><?= number_format($cartItem->product->price, 0, '', ' ') ?> ₽</div>
                    <div class="product-quantity">Количество: <?= $cartItem->count ?> шт.</div>
                </div>
                
                <div class="product-total">
                    <?= number_format($cartItem->product->price * $cartItem->count, 0, '', ' ') ?> ₽
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <div class="order-summary animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
        <div class="summary-row">
            <span>Доставка</span>
            <span>Бесплатно</span>
        </div>
        <div class="summary-row">
            <span>Итого</span>
            <span><?= number_format($model->getTotalPrice(), 0, '', ' ') ?> ₽</span>
        </div>
    </div>
    
    <div class="action-buttons">
        <?= Html::a('<i class="fas fa-arrow-left"></i> Назад к заказам', ['index'], [
            'class' => 'action-btn back-btn animate__animated animate__fadeInLeft'
        ]) ?>
         <?php if (Yii::$app->user->identity->isAdmin()): ?>
        <?= Html::a('<i class="fas fa-edit"></i> Редактировать', ['update', 'id' => $model->id], [
            'class' => 'action-btn update-btn animate__animated animate__fadeInUp'
        ]) ?>
          <?php endif; ?>
    </div>
</div>

<?php
// Добавляем анимации при наведении
$this->registerJs(<<<JS
    $(document).ready(function() {
        // Анимация при наведении на товары
        $('.product-item').hover(
            function() {
                $(this).addClass('animate__animated animate__pulse');
            },
            function() {
                $(this).removeClass('animate__animated animate__pulse');
            }
        );
        
        // Пульсация статуса заказа
        setInterval(function() {
            $('.order-status').toggleClass('animate__pulse');
        }, 3000);
    });
JS);
?>