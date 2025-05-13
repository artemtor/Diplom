<?php

use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Catergory;

/** @var yii\web\View $this */
/** @var app\models\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Каталог вязаных изделий';
$this->params['breadcrumbs'][] = $this->title;

// Подключаем ресурсы
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
        --shadow: 0 4px 20px rgba(139, 94, 60, 0.15);
    }

    body {
        background-color: var(--light-bg);
        font-family: 'Montserrat', sans-serif;
    }

    .page-title {
        font-family: 'Marck Script', cursive;
        font-size: 3rem;
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

    /* Карточки товаров */
    #products-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .product-card {
        border: 1px solid rgba(139, 94, 60, 0.2);
        border-radius: 15px;
        background: white;
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
        box-shadow: var(--shadow);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(139, 94, 60, 0.2);
    }

    .product-image-container {
        height: 250px;
        overflow: hidden;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .product-body {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-title {
        font-family: 'Caveat', cursive;
        font-size: 1.8rem;
        color: var(--main-color);
        margin-bottom: 0.5rem;
        line-height: 1.2;
        min-height: 4.4rem;
    }

    .product-price {
        font-size: 1.5rem;
        color: var(--secondary-color);
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    .product-price::after {
        content: ' ₽';
    }

    .product-actions {
        margin-top: auto;
    }

    /* Кнопки */
    .btn-knitting {
        font-family: 'Caveat', cursive;
        font-size: 1.3rem;
        padding: 0.5rem 1.5rem;
        border-radius: 30px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-primary-knitting {
        background-color: var(--main-color);
        color: white;
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
    }

    .btn-outline-knitting:hover {
        background-color: rgba(139, 94, 60, 0.1);
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(139, 94, 60, 0.1);
    }

    /* Кнопка избранного */
    .favorite-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        color: #ccc;
        transition: all 0.3s ease;
        z-index: 10;
    }

    .favorite-btn:hover {
        color: #ff4757;
        transform: scale(1.1);
    }

    .favorite-btn.active {
        color: #ff4757;
    }

    /* Фильтры */
    .filter-container {
        background: white;
        border-radius: 10px;
        padding: 1rem;
        box-shadow: var(--shadow);
        margin-bottom: 1.5rem;
        position: relative;
    }

    .filter-toggle {
        display: none;
    }

    .filter-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        padding: 0.5rem 0;
    }

    .filter-title {
        font-family: 'Caveat', cursive;
        font-size: 1.5rem;
        color: var(--main-color);
        margin: 0;
    }

    .filter-icon {
        transition: transform 0.3s;
    }

    .filter-toggle:checked~.filter-header .filter-icon {
        transform: rotate(180deg);
    }

    .filter-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    .filter-toggle:checked~.filter-content {
        max-height: 1000px;
    }

    .filter-group {
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px dashed rgba(139, 94, 60, 0.2);
    }

    .filter-group-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--secondary-color);
        margin-bottom: 0.5rem;
    }

    .filter-options {
        display: flex;
        flex-wrap: wrap;
        gap: 0.3rem;
    }

    .filter-option {
        display: inline-block;
        padding: 0.3rem 0.8rem;
        border-radius: 15px;
        background: var(--light-bg);
        color: var(--text-color);
        transition: all 0.3s;
        font-size: 0.8rem;
        border: 1px solid rgba(139, 94, 60, 0.1);
    }

    .filter-option:hover,
    .filter-option.active {
        background-color: var(--main-color);
        color: white;
        text-decoration: none;
    }

    /* Стили для цветных кружков */
    .color-option {
        width: 30px;
        height: 30px;
        padding: 0;
        border-radius: 50%;
        position: relative;
    }

    .color-option::after {
        content: '';
        position: absolute;
        top: -3px;
        left: -3px;
        right: -3px;
        bottom: -3px;
        border: 2px solid transparent;
        border-radius: 50%;
        transition: all 0.3s;
    }

    .color-option.active::after {
        border-color: var(--main-color);
    }

    .price-range {
        width: 100%;
        margin: 0.5rem 0;
    }

    .price-values {
        display: flex;
        justify-content: space-between;
        font-size: 0.8rem;
        color: var(--secondary-color);
    }

    /* Анимации */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .product-card {
        animation: fadeIn 0.6s ease forwards;
        opacity: 0;
    }

    /* Адаптивность */
    @media (max-width: 992px) {
        #products-container {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2.2rem;
        }

        .filter-panel {
            padding: 1.5rem;
        }

        .product-title {
            font-size: 1.6rem;
            min-height: auto;
        }

        .product-price {
            font-size: 1.3rem;
        }
    }

    /* Стили для цветных кружков */
    .color-option {
        width: 30px;
        height: 30px;
        padding: 0;
        border-radius: 50%;
        position: relative;
        display: inline-block;
        border: 1px solid #ddd;
    }

    .color-option.all-colors {
        width: auto;
        height: auto;
        padding: 0.3rem 0.8rem;
    }

    .color-option.active::after {
        content: '';
        position: absolute;
        top: -3px;
        left: -3px;
        right: -3px;
        bottom: -3px;
        border: 2px solid var(--main-color);
        border-radius: 50%;
    }

    /* Белый цвет нужно выделять особо */
    .color-option[style*="#ffffff"],
    .color-option[style*="#FFFFFF"] {
        border: 1px solid #ccc !important;
    }
</style>

<div class="product-index">
    <h1 class="page-title animate__animated animate__fadeIn"><?= Html::encode($this->title) ?></h1>

    <div class="container">
        <!-- Компактные фильтры с аккордеоном -->
        <div class="filter-container animate__animated animate__fadeIn">
            <input type="checkbox" id="filter-toggle" class="filter-toggle" checked>
            <label for="filter-toggle" class="filter-header">
                <h3 class="filter-title">Фильтры</h3>
                <i class="fas fa-chevron-down filter-icon"></i>
            </label>

            <div class="filter-content">
                <?php $form = ActiveForm::begin([
                    'id' => 'filter-form',
                    'method' => 'get',
                    'action' => ['catalog'],
                    'options' => ['class' => 'ajax-form'],
                ]); ?>

                <!-- Фильтр по цене -->
                <div class="filter-group">
                    <div class="filter-group-title">Цена, ₽</div>
                    <input type="range" class="price-range" min="0" max="10000" step="100"
                        name="ProductSearch[maxPrice]"
                        value="<?= $searchModel->maxPrice ?? 10000 ?>">
                    <div class="price-values">
                        <span>0</span>
                        <span class="max-price-value"><?= ($searchModel->maxPrice ?? 10000) ?></span>
                    </div>
                </div>
                <div class="filter-group">
                    <div class="filter-group-title">Категория</div>
                    <?= Html::dropDownList(
                        'ProductSearch[category_id]',
                        $searchModel->category_id,
                        \yii\helpers\ArrayHelper::map(Catergory::find()->all(), 'id', 'name'),
                        ['class' => 'form-control', 'prompt' => 'Все категории']
                    ) ?>
                </div>
                <div class="text-right">
                    <button type="reset" class="btn-knitting btn-outline-knitting btn-sm mr-2">Сбросить</button>
                    <button type="submit" class="btn-knitting btn-primary-knitting btn-sm">Применить</button>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

        <div class="products-grid" id="products-container">
            <?php foreach ($dataProvider->models as $index => $product): ?>
                <div class="product-card animate__animated animate__fadeIn" style="animation-delay: <?= $index * 0.1 ?>s">
                    <!-- Кнопка избранного -->
                    <?php if (!Yii::$app->user->isGuest): ?>
                        <button class="favorite-btn <?= Yii::$app->user->identity->isFavorite($product->id) ? 'active' : '' ?>"
                            data-product-id="<?= $product->id ?>">
                            <i class="<?= Yii::$app->user->identity->isFavorite($product->id) ? 'fas' : 'far' ?> fa-heart"></i>
                        </button>
                    <?php endif; ?>

                    <div class="product-image-container">
                        <a href="<?= Url::to(['view', 'product_id' => $product->id]) ?>">
                            <?= Html::img('@web/' . $product->photo, [
                                'class' => 'product-image',
                                'alt' => $product->name
                            ]) ?>
                        </a>
                    </div>

                    <div class="product-body">
                        <h3 class="product-title"><?= Html::encode($product->name) ?></h3>
                        <div class="product-price"><?= number_format($product->price, 0, '', ' ') ?></div>

                        <div class="product-actions">
                            <div class="d-flex justify-content-between">
                                <a href="<?= Url::to(['view', 'product_id' => $product->id]) ?>"
                                    class="btn-knitting btn-outline-knitting">
                                    <i class="fas fa-eye mr-2"></i> Подробнее
                                </a>

                                <?php if (!Yii::$app->user->isGuest): ?>
                                    <?php if (Yii::$app->user->identity->isAdmin()): ?>
                                        <a href="<?= Url::to(['update', 'product_id' => $product->id]) ?>"
                                            class="btn-knitting btn-outline-knitting">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?= Url::to(['cart/add', 'product_id' => $product->id]) ?>"
                                            class="btn-knitting btn-primary-knitting">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
$this->registerJs(<<<JS
 $(document).ready(function() {
     // Функция инициализации сетки и анимации
     function initProductGridAndAnimations() {
         // Восстанавливаем грид-раскладку
         var container = $('#products-container');
         container.css('display', 'grid');
         
         // Инициализация анимации
         var productCards = $('.product-card');
         if (productCards.length > 0) {
             gsap.set(productCards, { opacity: 1, y: 0 });
             gsap.from(productCards, {
                 duration: 0.6,
                 opacity: 0,
                 y: 20,
                 stagger: 0.1,
                 ease: "power2.out"
             });
         }
     }
     
     // Инициализация при первой загрузке
     initProductGridAndAnimations();
     
     // AJAX-фильтрация
     $(document).on('submit', '#filter-form', function(e) {
         e.preventDefault();
         
         // Показываем индикатор загрузки
         $('#products-container').html('<div class="text-center py-5"><i class="fas fa-spinner fa-spin fa-3x" style="color: var(--main-color);"></i></div>');
         
         $.ajax({
             url: $(this).attr('action'),
             type: 'GET',
             data: $(this).serialize(),
             success: function(response) {
                 // Получаем только содержимое products-container из ответа
                 var newContent = $(response).filter('#products-container').html();
                 if (!newContent) {
                     newContent = $(response).find('#products-container').html();
                 }
                 
                 $('#products-container').html(newContent || '<div class="col-12 text-center py-5">Товары не найдены</div>');
                 initProductGridAndAnimations();
             },
             error: function(xhr) {
                 console.error('AJAX Error:', xhr.responseText);
                 $('#products-container').html('<div class="alert alert-danger">Ошибка загрузки данных. Пожалуйста, попробуйте еще раз.</div>');
             }
         });
     });

    
    // Обновление значения цены
    $('.price-range').on('input', function() {
        $('.max-price-value').text($(this).val());
    });
    
    // Отправка формы при изменении цены
    $('.price-range').on('change', function() {
        $('#filter-form').submit();
    });
    
    // Сброс фильтров
    $('[type="reset"]').click(function(e) {
        e.preventDefault();
        $('.color-option').removeClass('active');
        $('.color-option.all-colors').addClass('active');
        $('#color-input').val('');
        $('.price-range').val(5000);
        $('.max-price-value').text(5000);
        $('#filter-form').submit();
    });
    
    // Избранное
    $(document).on('click', '.favorite-btn', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        var btn = $(this);
        var productId = btn.data('product-id');
        var icon = btn.find('i');
        
        $.post('/favorite/toggle', {productId: productId}, function(response) {
            if (response.success) {
                if (response.status === 'added') {
                    btn.addClass('active');
                    icon.removeClass('far').addClass('fas');
                    gsap.to(btn, {
                        duration: 0.3,
                        scale: 1.3,
                        yoyo: true,
                        repeat: 1,
                        ease: "elastic.out(1, 0.5)"
                    });
                } else {
                    btn.removeClass('active');
                    icon.removeClass('fas').addClass('far');
                }
            } else {
                alert(response.message);
            }
        }).fail(function(xhr) {
            console.error('Favorite Error:', xhr.responseText);
        });
    });
});
JS);
?>