<?php
use app\models\Cart;
use app\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\Modal;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Моя корзина';
$this->params['breadcrumbs'][] = $this->title;

// Подключаем стили и скрипты
$this->registerCssFile('https://fonts.googleapis.com/css2?family=Caveat:wght@400;700&family=Marck+Script&family=Montserrat:wght@300;400;600&display=swap');
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
        /* Стили для модального окна */
        .modal-header {
        border-bottom: 2px solid var(--accent-color);
        background: var(--light-bg);
    }   
    .modal-title {
        font-family: 'Marck Script', cursive;
        color: var(--main-color);
    }
    .modal-body {
        padding: 2rem;
    }
    .order-form .form-group {
        margin-bottom: 1.5rem;
    }  
    .order-form label {
        font-weight: 600;
        color: var(--secondary-color);
    }  
    .order-form .form-control {
        border: 1px solid rgba(139, 94, 60, 0.3);
        border-radius: 8px;
        padding: 0.8rem 1rem;
    }
    .order-form .form-control:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 0.25rem rgba(212, 163, 115, 0.25);
    }
    .order-form .btn-submit {
        font-family: 'Caveat', cursive;
        font-size: 1.3rem;
        padding: 0.6rem 2rem;
        background: var(--main-color);
        border: none;
        border-radius: 30px;
        color: white;
        transition: all 0.3s;
    }
    .order-form .btn-submit:hover {
        background: var(--secondary-color);
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(139, 94, 60, 0.2);
    }
    body {
        background-color: var(--light-bg);
        font-family: 'Montserrat', sans-serif;
    }
    
    .cart-title {
        font-family: 'Marck Script', cursive;
        font-size: 2.5rem;
        color: var(--main-color);
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
    }
    .cart-title::after {
        content: '';
        display: block;
        width: 150px;
        height: 3px;
        background: linear-gradient(90deg, var(--main-color), var(--accent-color));
        margin: 0.5rem auto 0;
    } 
    .cart-container {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: var(--shadow);
        margin-bottom: 2rem;
    }   
    .cart-item {
        display: flex;
        align-items: center;
        padding: 1.5rem 0;
        border-bottom: 1px dashed rgba(139, 94, 60, 0.2);
    }
    
    .cart-item:last-child {
        border-bottom: none;
    }
    
    .product-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
        margin-right: 1.5rem;
    }
    
    .product-info {
        flex-grow: 1;
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
    
    .quantity-control {
        display: flex;
        align-items: center;
        margin: 0 1.5rem;
    }
    
    .quantity-btn {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: var(--light-bg);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .quantity-btn:hover {
        background: var(--accent-color);
        color: white;
    }
    
    .quantity-input {
        width: 50px;
        text-align: center;
        margin: 0 0.5rem;
        border: 1px solid rgba(139, 94, 60, 0.2);
        border-radius: 5px;
        padding: 0.3rem;
    }
    
    .remove-btn {
        background: none;
        border: none;
        color: #dc3545;
        font-size: 1.2rem;
        cursor: pointer;
        transition: transform 0.3s;
    }
    
    .remove-btn:hover {
        transform: scale(1.2);
    }
    
    .cart-summary {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: var(--shadow);
        margin-top: 2rem;
        margin-bottom: 20px;
    }
    
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        font-size: 1.1rem;
    }
    
    .summary-total {
        font-weight: 600;
        font-size: 1.3rem;
        color: var(--main-color);
        border-top: 1px solid rgba(139, 94, 60, 0.2);
        padding-top: 1rem;
        margin-top: 1rem;
    }
    
    .checkout-btn {
        font-family: 'Caveat', cursive;
        font-size: 1.5rem;
        padding: 0.8rem 2rem;
        border-radius: 30px;
        background: var(--main-color);
        color: white;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        display: block;
        width: 100%;
        margin-top: 1.5rem;
        text-align: center;
    }
    
    .checkout-btn:hover {
        background: var(--secondary-color);
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(139, 94, 60, 0.2);
    }
    
    .empty-cart {
        text-align: center;
        padding: 3rem;
        font-family: 'Caveat', cursive;
        font-size: 1.8rem;
        color: var(--main-color);
    }
    
    .continue-shopping {
        display: inline-block;
        margin-top: 1.5rem;
        color: var(--main-color);
        font-weight: 600;
        text-decoration: none;
        border-bottom: 1px dashed var(--main-color);
    }
    
    @media (max-width: 768px) {
        .cart-item {
            flex-direction: column;
            text-align: center;
        }
        
        .product-image {
            margin-right: 0;
            margin-bottom: 1rem;
        }
        
        .quantity-control {
            margin: 1rem 0;
        }
    }
</style>

<div class="cart-index">
    <h1 class="cart-title"><?= Html::encode($this->title) ?></h1>

    <div class="container">
        <div class="cart-container">
            <?php if ($dataProvider->getCount() > 0): ?>
                <?php foreach ($dataProvider->models as $item): ?>
                    <div class="cart-item">
                        <?= Html::img('@web/' . $item->product->photo, [
                            'class' => 'product-image',
                            'alt' => $item->product->name
                        ]) ?>
                        
                        <div class="product-info">
                            <div class="product-name"><?= Html::encode($item->product->name) ?></div>
                            <div class="product-price"><?= number_format($item->product->price, 0, '', ' ') ?> ₽</div>
                        </div>
                        
                        <div class="quantity-control">
                            <button class="quantity-btn minus-btn" data-id="<?= $item->id ?>">-</button>
                            <input type="number" class="quantity-input" value="<?= $item->count ?>" min="1" data-id="<?= $item->id ?>">
                            <button class="quantity-btn plus-btn" data-id="<?= $item->id ?>">+</button>
                        </div>
                        
                        <div class="product-total">
                            <?= number_format($item->product->price * $item->count, 0, '', ' ') ?> ₽
                        </div>
                        
                        <button class="remove-btn" data-id="<?= $item->id ?>">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-cart">
                    Ваша корзина пуста
                    <div>
                        <?= Html::a('Продолжить покупки', ['product/catalog'], ['class' => 'continue-shopping']) ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if ($dataProvider->getCount() > 0): ?>
            <div class="cart-summary">
                <div class="summary-row">
                    <span>Товары (<?= $dataProvider->getTotalCount() ?>)</span>
                    <span><?= number_format($totalPrice, 0, '', ' ') ?> ₽</span>
                </div>
                <div class="summary-row">
                    <span>Доставка</span>
                    <span>Бесплатно</span>
                </div>
                <div class="summary-row summary-total">
                    <span>Итого</span>
                    <span><?= number_format($totalPrice, 0, '', ' ') ?> ₽</span>
                </div>
                
                <!-- Кнопка вызова модального окна -->
                <?php Modal::begin([
                    'title' => '<h2 class="modal-title">Оформление заказа</h2>',
                    'toggleButton' => [
                        'label' => 'Оформить заказ',
                        'class' => 'checkout-btn',
                        'id' => 'checkout-modal-btn'
                    ],
                    'options' => [
                        'class' => 'fade'
                    ],
                    'dialogOptions' => [
                        'class' => 'modal-dialog-centered'
                    ]
                ]); ?>
                
                <?php $form = ActiveForm::begin([
                    'id' => 'order-form',
                    'action' => ['order/create'],
                    'options' => [
                        'class' => 'order-form'
                    ]
                ]); ?>
                
                <?= $form->field(new Order(), 'user_id')->hiddenInput([
                    'value' => Yii::$app->user->id
                ])->label(false) ?>
                
                <?= $form->field(new Order(), 'adress')->textInput([
                    'placeholder' => 'Укажите адрес доставки',
                    'required' => true
                ])->label('Адрес доставки') ?>
                
                <?= $form->field(new Order(), 'payment_method')->dropDownList([
                    'При получении наличными' => 'Наличными при получении',
                    'При получении по карте' => 'Картой при получении',
                ], [
                    'prompt' => 'Выберите способ оплаты',
                    'required' => true
                ])->label('Способ оплаты') ?>
            
                
                <div class="text-center">
                    <?= Html::submitButton('Подтвердить заказ', [
                        'class' => 'btn-submit'
                    ]) ?>
                </div>
                
                <?php ActiveForm::end(); ?>
                
                <?php Modal::end(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
$this->registerJs(<<<JS
$(document).ready(function() {
    // Функция для обновления количества товара
    function updateCartItem(itemId, quantity) {
        $.post('/cart/update', {
            id: itemId,
            count: quantity
        }, function(response) {
            if (response.success) {
                location.reload();
            } else {
                showAlert('Ошибка обновления: ' + (response.message || 'Неизвестная ошибка'), 'danger');
            }
        }).fail(function() {
            showAlert('Ошибка соединения с сервером', 'danger');
        });
    }

    // Функция для удаления товара
    function removeCartItem(itemId) {
        $.post('/cart/delete', {
            id: itemId
        }, function(response) {
            if (response.success) {
                location.reload();
            } else {
                showAlert('Ошибка удаления: ' + (response.message || 'Неизвестная ошибка'), 'danger');
            }
        }).fail(function() {
            showAlert('Ошибка соединения с сервером', 'danger');
        });
    }

    // Функция для показа уведомлений
    function showAlert(message, type = 'success') {
        const alert = $('<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
            message +
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
            '</div>');
        
        $('#alerts-container').append(alert);
        setTimeout(() => alert.alert('close'), 5000);
    }

    // Увеличение количества товара
    $('.plus-btn').click(function() {
        const itemId = $(this).data('id');
        const input = $(this).siblings('.quantity-input');
        input.val(parseInt(input.val()) + 1);
        updateCartItem(itemId, input.val());
    });
    
    // Уменьшение количества товара
    $('.minus-btn').click(function() {
        const itemId = $(this).data('id');
        const input = $(this).siblings('.quantity-input');
        if (parseInt(input.val()) > 1) {
            input.val(parseInt(input.val()) - 1);
            updateCartItem(itemId, input.val());
        }
    });
    
    // Ручное изменение количества
    $('.quantity-input').change(function() {
        const itemId = $(this).data('id');
        const value = parseInt($(this).val());
        if (isNaN(value) || value < 1) {
            $(this).val(1);
        }
        updateCartItem(itemId, $(this).val());
    });
    
    // Удаление товара
    $('.remove-btn').click(function() {
        const itemId = $(this).data('id');
        const productName = $(this).closest('.cart-item').find('.product-name').text().trim();
        
        if (confirm('Вы действительно хотите удалить "' + productName + '" из корзины?')) {
            $(this).html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);
            removeCartItem(itemId);
        }
    });
    
    // Обработка формы заказа
    $('#order-form').on('submit', function(e) {
        e.preventDefault();
        
        const form = $(this);
        const submitBtn = form.find('[type="submit"]');
        submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Обработка...')
            .prop('disabled', true);
        
        // Удаляем предыдущие ошибки
        $('.invalid-feedback').remove();
        $('.is-invalid').removeClass('is-invalid');
        $('.alert-danger').remove();
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showAlert('Заказ успешно оформлен! Перенаправляем...', 'success');
                    setTimeout(() => window.location.href = response.redirect, 1500);
                } else {
                    if (response.errors) {
                        // Показываем ошибки валидации
                        $.each(response.errors, function(field, errors) {
                            const input = form.find('[name="Order[' + field + ']"]');
                            input.addClass('is-invalid');
                            input.after('<div class="invalid-feedback">' + errors.join('<br>') + '</div>');
                        });
                    } else {
                        showAlert(response.message || 'Произошла ошибка при оформлении заказа', 'danger');
                    }
                }
            },
            error: function(xhr) {
                showAlert('Ошибка соединения с сервером. Пожалуйста, попробуйте позже.', 'danger');
            },
            complete: function() {
                submitBtn.html('Подтвердить заказ').prop('disabled', false);
            }
        });
    });

    // Отключаем нативную браузерную валидацию
    document.getElementById('order-form').setAttribute('novalidate', 'novalidate');
    
    // Закрытие модального окна после успешного заказа
    $(document).on('hidden.bs.modal', '#w0', function () {
        $('#order-form')[0].reset();
        $('.invalid-feedback').remove();
        $('.is-invalid').removeClass('is-invalid');
    });
});
JS
);
?>