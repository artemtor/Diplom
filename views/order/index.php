<?php
use app\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::$app->user->identity->isAdmin() ? 'Все заказы' : 'Мои заказы';
$this->params['breadcrumbs'][] = $this->title;

// Подключаем стили и скрипты
$this->registerCssFile('https://fonts.googleapis.com/css2?family=Caveat:wght@400;700&family=Marck+Script&family=Montserrat:wght@300;400;600&display=swap');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
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
        background-color: var(--light-bg);
        font-family: 'Montserrat', sans-serif;
    }
    
    .orders-container {
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
        color: var(--secondary-color);
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
    
    .product-item:nth-child(1) { animation-delay: 0.1s; }
    .product-item:nth-child(2) { animation-delay: 0.2s; }
    .product-item:nth-child(3) { animation-delay: 0.3s; }
    .product-item:nth-child(4) { animation-delay: 0.4s; }
    .product-item:nth-child(5) { animation-delay: 0.5s; }
    
    /* Стили для кнопок сортировки */
    .sort-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }
    
    .sort-buttons .btn {
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        border-radius: 30px;
        padding: 0.5rem 1.5rem;
        transition: var(--transition);
        box-shadow: var(--shadow);
    }
    
    .sort-buttons .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(139, 94, 60, 0.25);
    }
</style>

<div class="orders-container">
    <h1 class="page-title animate__animated animate__fadeIn"><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->identity->isAdmin()): ?>
        <div class="sort-buttons">
            <?= Html::a('Все заказы', ['order/index'], ['class' => 'btn btn-secondary']) ?>
            <?= Html::a('Новые', ['order/index', 'sort' => 'status_id', 'OrderSearch[status_id]' => 1], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Подтверждены', ['order/index', 'sort' => 'status_id', 'OrderSearch[status_id]' => 2], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Отменены', ['order/index', 'sort' => 'status_id', 'OrderSearch[status_id]' => 3], ['class' => 'btn btn-danger']) ?>
        </div>
    <?php endif; ?>

    <?php if ($dataProvider->getCount() > 0): ?>
        <?php foreach ($dataProvider->models as $index => $model): ?>
            <div class="order-card" style="animation-delay: <?= $index * 0.1 ?>s">
                <div class="order-header">
                    <div class="order-id">Заказ #<?= $model->id ?></div>
                    <div class="order-date"><?= Yii::$app->formatter->asDate($model->date, 'long') ?></div>
                </div>
                
                <div class="order-body">
                    <div class="order-details">
                        <div class="detail-item">
                            <div class="detail-label">Статус</div>
                            <div class="detail-value">
                                <span class="status-badge status-<?= strtolower($model->status->name) ?>">
                                    <?= $model->status->name ?>
                                </span>
                            </div>
                        </div>
                    
                        
                        <div class="detail-item">
                            <div class="detail-label">Способ оплаты</div>
                            <div class="detail-value"><?= $model->payment_method ?></div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Адрес доставки</div>
                            <div class="detail-value"><?= $model->adress ?></div>
                        </div>
                    </div>
                    
                    <div class="order-actions">
                        <?= Html::a('<i class="fas fa-eye"></i> Подробнее', ['view', 'id' => $model->id], [
                            'class' => 'action-btn view-btn animate__animated animate__pulse animate__infinite'
                        ]) ?>
                        
                        <!-- <?php if ($model->status_id == 1): // Если статус "Новый" ?>
                            <?= Html::a('<i class="fas fa-times"></i> Отменить', ['cancel', 'id' => $model->id], [
                                'class' => 'action-btn cancel-btn',
                                'data' => [
                                    'confirm' => 'Вы уверены, что хотите отменить этот заказ?',
                                    'method' => 'post',
                                ]
                            ]) ?>
                        <?php endif; ?> -->
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="empty-orders animate__animated animate__fadeIn">
            <div class="empty-icon">
                <i class="fas fa-box-open"></i>
            </div>
            <div class="empty-text">У вас пока нет заказов</div>
        </div>
    <?php endif; ?>
</div>

<?php
// Добавляем анимацию при наведении
$this->registerJs(<<<JS
    $(document).ready(function() {
        // Анимация при наведении на кнопки
        $('.action-btn').hover(
            function() {
                $(this).addClass('animate__animated animate__pulse');
            },
            function() {
                $(this).removeClass('animate__animated animate__pulse');
            }
        );
        
        // Периодическая анимация для привлечения внимания
        setInterval(function() {
            $('.create-btn').toggleClass('animate__pulse');
        }, 2000);
    });
JS);
?>