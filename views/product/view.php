<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Вязаные изделия', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// Подключение ресурсов
$this->registerCssFile('https://fonts.googleapis.com/css2?family=Caveat:wght@400;700&family=Marck+Script&family=Montserrat:wght@300;400;600&display=swap');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
?>

<style>
    :root {
        --main-color: #7D6B5E;
        --secondary-color: #5a3e36;
        --accent-color: #d4a373;
        --light-bg: #fffaf0;
        --text-color: #5a3e36;
        --text1-color: #FFFFFF;
        --shadow: 0 4px 20px rgba(139, 94, 60, 0.15);
        --border-radius: 15px;
        --transition: all 0.3s ease;
    }
    
    body {
        background-color: var(--light-bg);
        font-family: 'Montserrat', sans-serif;
    }
    
    .product-view {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 15px;
    }
    
    .product-header {
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
    }
    
    .product-title {
        font-family: 'Marck Script', cursive;
        font-size: 3rem;
        color: var(--main-color);
        margin-bottom: 1rem;
        display: inline-block;
    }
    
    .product-title::after {
        content: '';
        display: block;
        width: 50%;
        height: 3px;
        background: linear-gradient(90deg, var(--main-color), var(--accent-color));
        margin: 0.5rem auto 0;
        transform: scaleX(0);
        transform-origin: right;
        transition: transform 0.5s ease;
    }
    
    .product-title:hover::after {
        transform: scaleX(1);
        transform-origin: left;
    }
    
    .product-container {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: var(--shadow);
        position: relative;
        overflow: hidden;
    }
    
    .product-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--main-color), var(--accent-color), var(--main-color));
    }
    
    .product-gallery {
        flex: 1;
        min-width: 300px;
        position: relative;
    }
    
    .main-image {
        width: 100%;
        height: 400px;
        object-fit: contain;
        border-radius: 10px;
        transition: transform 0.3s ease;
        cursor: zoom-in;
        background-color: var(--light-bg);
        padding: 1rem;
    }
    
    .main-image:hover {
        transform: scale(1.02);
    }
    
    .product-details {
        flex: 1;
        min-width: 300px;
    }
    
    .price-container {
        display: flex;
        align-items: center;
        margin: 1.5rem 0;
    }
    
    .current-price {
        font-family: 'Caveat', cursive;
        font-size: 2.5rem;
        color: var(--main-color);
        margin-right: 1rem;
    }
    
    .product-meta {
        margin: 2rem 0;
    }
    
    .meta-item {
        display: flex;
        margin-bottom: 1rem;
        align-items: center;
    }
    
    .meta-label {
        font-weight: 600;
        color: var(--secondary-color);
        min-width: 120px;
        display: flex;
        align-items: center;
    }
    
    .meta-label i {
        margin-right: 0.5rem;
        color: var(--accent-color);
    }
    
    .meta-value {
        font-family: 'Caveat', cursive;
        font-size: 1.3rem;
        color: var(--text-color);
    }
    
    .color-swatch {
        display: inline-block;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        margin-right: 0.5rem;
        border: 1px solid #ddd;
    }
    
    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        flex-wrap: wrap;
    }
    
    .btn-knitting {
        font-family: 'Caveat', cursive;
        font-size: 1.3rem;
        padding: 0.7rem 1.5rem;
        border-radius: 30px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-primary-knitting {
        background-color: var(--main-color);
        color: white;
        flex: 1;
        min-width: 200px;
    }
    
    .btn-primary-knitting:hover {
        background-color: var(--secondary-color);
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(139, 94, 60, 0.2);
    }
    
    .btn-outline-knitting {
        background-color: transparent;
        color: var(--main-color);
        border: 2px solid var(--main-color);
        flex: 1;
        min-width: 200px;
    }
    
    .btn-outline-knitting:hover {
        background-color: rgba(139, 94, 60, 0.1);
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(139, 94, 60, 0.1);
    }
    
    .btn-danger-knitting {
        background-color: #dc3545;
        color: white;
    }
    
    .btn-danger-knitting:hover {
        background-color: #c82333;
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(220, 53, 69, 0.2);
    }
    
    .favorite-btn {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        cursor: pointer;
        color: #ccc;
        transition: all 0.3s ease;
        z-index: 10;
    }
    
    .favorite-btn:hover, .favorite-btn.active {
        color: #ff4757;
        transform: scale(1.1);
    }
    
    .badge-knitting {
        display: inline-block;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        background-color: var(--accent-color);
        color: white;
        margin-left: 0.5rem;
        vertical-align: middle;
    }
    .image-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.9);
        z-index: 1000;
        cursor: zoom-out;
    }
    
    .modal-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-width: 90%;
        max-height: 90%;
    }
    
    .modal-content img {
        width: auto;
        height: auto;
        max-width: 100%;
        max-height: 90vh;
        object-fit: contain;
    }
    
    .close-modal {
        position: absolute;
        top: 40px;
        right: 30px;
        color: white;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
        z-index: 1001;
    }
    
    .close-modal:hover {
        color: var(--accent-color);
    }
    /* Анимации */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    .pulse-animation {
        animation: pulse 2s infinite;
    }
    
    /* Адаптивность */
    @media (max-width: 768px) {
        .product-title {
            font-size: 2.2rem;
        }
        
        .product-container {
            padding: 1.5rem;
        }
        
        .main-image {
            height: 300px;
        }
    }
</style>

<div class="product-view animate__animated animate__fadeIn">
    <div class="product-header">
        <h1 class="product-title"><?= Html::encode($this->title) ?></h1>
    </div>
    
    <div class="product-container">
        <!-- Кнопка избранного -->
        <button class="favorite-btn" id="favoriteBtn" data-product-id="<?= $model->id ?>">
    <i class="<?= (Yii::$app->user->isGuest ? in_array($model->id, Yii::$app->session->get('favorites', [])) : (!Yii::$app->user->isGuest && Yii::$app->user->identity->isFavorite($model->id))) ? 'fas' : 'far' ?> fa-heart"></i>
</button>
        
        <!-- Галерея товара (одно фото) -->
        <div class="product-gallery">
            <?= Html::img('@web/' . $model->photo, [
                'class' => 'main-image',
                'alt' => $model->name,
                'id' => 'mainImage'
            ]) ?>
        </div>
        <div id="imageModal" class="image-modal">
        <span class="close-modal">&times;</span>
        <div class="modal-content">
            <?= Html::img('@web/' . $model->photo, [
                'alt' => $model->name,
                'id' => 'modalImage'
            ]) ?>
        </div>
    </div>
        <!-- Детали товара -->
        <div class="product-details">
            <div class="price-container">
                <span class="current-price"><?= number_format($model->price, 2, '.', ' ') ?> ₽</span>
                <span class="badge-knitting pulse-animation">Хит продаж</span>
            </div>
            
            <div class="product-description">
                <p style="font-family: 'Caveat', cursive; font-size: 1.4rem; line-height: 1.6;">
                    Это прекрасное вязаное изделие создано вручную с любовью и заботой. 
                    Каждая петелька связана с вниманием к деталям, чтобы обеспечить 
                    максимальный комфорт и стиль для своего обладателя.
                </p>
            </div>
            
            <div class="product-meta">
                <div class="meta-item">
                    <span class="meta-label"><i class="fas fa-palette"></i> Цвет</span>
                    <span class="meta-value">
                        <span class="color-swatch" style="background-color: <?= $model->color ?>;"></span>
                        <?= $model->color ?>
                    </span>
                </div>
                
                <div class="meta-item">
                    <span class="meta-label"><i class="fas fa-calendar-alt"></i> Дата добавления</span>
                    <span class="meta-value"><?= Yii::$app->formatter->asDate($model->date, 'long') ?></span>
                </div>
                
                <div class="meta-item">
                    <span class="meta-label"><i class="fas fa-tag"></i> Категория</span>
                    <span class="meta-value"><?= $model->category->name ?? 'Без категории' ?></span>
                </div>
                
                <div class="meta-item">
                    <span class="meta-label"><i class="fas fa-ruler"></i> Размер</span>
                    <span class="meta-value">Универсальный (под заказ возможны другие размеры)</span>
                </div>
            
            <div class="action-buttons">
                <?php if(!Yii::$app->user->isGuest): ?>
                    <?php if (Yii::$app->user->identity->isAdmin()): ?>
                        <?= Html::a('<i class="fas fa-edit mr-2"></i> Редактировать', ['update', 'product_id' => $model->id], [
                            'class' => 'btn-knitting btn-outline-knitting'
                        ]) ?>
                        
                        <?= Html::a('<i class="fas fa-trash-alt mr-2"></i> Удалить', ['delete', 'product_id' => $model->id], [
                            'class' => 'btn-knitting btn-danger-knitting',
                            'data' => [
                                'confirm' => 'Вы уверены, что хотите удалить этот товар?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    <?php else: ?>
                        <?= Html::a('<i class="fas fa-shopping-basket mr-2"></i> В корзину', ['cart/add', 'product_id' => $model->id], [
                            'class' => 'btn-knitting btn-primary-knitting animate__animated animate__pulse animate__infinite animate__slower'
                        ]) ?>
                    <?php endif; ?>
                <?php else: ?>
                    <?= Html::a('<i class="fas fa-sign-in-alt mr-2"></i> Войдите, чтобы купить', ['site/login'], [
                        'class' => 'btn-knitting btn-outline-knitting'
                    ]) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
// JavaScript для интерактивности
$this->registerJs(<<<JS
    // Анимация при загрузке
    gsap.from(".product-header", {
        duration: 1,
        y: -50,
        opacity: 0,
        ease: "power2.out"
    });
    
    gsap.from(".product-gallery", {
        duration: 1,
        x: -50,
        opacity: 0,
        ease: "power2.out",
        delay: 0.2
    });
    
    gsap.from(".product-details", {
        duration: 1,
        x: 50,
        opacity: 0,
        ease: "power2.out",
        delay: 0.4
    });
    
    // Избранное
    $('#favoriteBtn').click(function() {
    const productId = $(this).data('product-id');
    const btn = $(this);
    
    $.ajax({
        url: '/favorite/toggle',
        method: 'POST',
        data: {productId: productId},
        success: function(response) {
            if (response.success) {
                if (response.status === 'added') {
                    btn.find('i').removeClass('far').addClass('fas');
                    // Анимация
                    btn.animate({scale: 1.3}, 200).animate({scale: 1}, 200);
                } else {
                    btn.find('i').removeClass('fas').addClass('far');
                }
            } else {
                alert(response.message);
            }
        },
        error: function() {
            alert('Произошла ошибка');
        }
    });
});
    
    // Увеличение изображения при клике
    $('#mainImage').click(function() {
        const modal = $('#imageModal');
        const modalImg = $('#modalImage');
        
        modal.css('display', 'block');
        modalImg.attr('src', $(this).attr('src'));
        
        // Закрытие при клике на крестик
        $('.close-modal').click(function() {
            modal.css('display', 'none');
        });
        
        // Закрытие при клике вне изображения
        modal.click(function(e) {
            if (e.target !== modalImg[0] && !modalImg.has(e.target).length) {
                modal.css('display', 'none');
            }
        });
        
        // Закрытие по ESC
        $(document).keydown(function(e) {
            if (e.key === "Escape") {
                modal.css('display', 'none');
            }
        });
    });
JS);
?>