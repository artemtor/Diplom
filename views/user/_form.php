<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<style>
    :root {
        --main-color: #7D6B5E;
        --secondary-color: #5a3e36;
        --accent-color: #d4a373;
        --light-bg: #fffaf0;
        --text-color: #5a3e36;
    }
    
    .register-page {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: var(--light-bg);
        padding: 20px;
    }
    
    .register-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(139, 94, 60, 0.15);
        padding: 2.5rem;
        width: 100%;
        max-width: 500px;
        position: relative;
        overflow: hidden;
    }
    
    .register-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--main-color), var(--accent-color));
    }
    
    .register-title {
        font-family: 'Marck Script', cursive;
        font-size: 2.5rem;
        color: var(--main-color);
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .register-title::after {
        content: '';
        display: block;
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg, var(--main-color), var(--accent-color));
        margin: 0.5rem auto 0;
    }
    
    .form-label {
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        color: var(--secondary-color);
        margin-bottom: 0.5rem;
    }
    
    .form-control {
        border: 1px solid rgba(139, 94, 60, 0.3);
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 1rem;
        transition: all 0.3s;
    }
    
    .form-control:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 0.25rem rgba(212, 163, 115, 0.25);
    }
    
    .btn-register {
        background-color: var(--main-color);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px;
        font-size: 1.1rem;
        font-family: 'Caveat', cursive;
        width: 100%;
        margin-top: 1rem;
        transition: all 0.3s;
        cursor: pointer;
    }
    
    .btn-register:hover {
        background-color: var(--secondary-color);
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(139, 94, 60, 0.2);
    }
    
    .password-field {
        position: relative;
    }
    
    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(50%);
        cursor: pointer;
        color: var(--secondary-color);
    }
    
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.9rem;
    }
    
    .register-footer {
        text-align: center;
        margin-top: 1.5rem;
        color: var(--text-color);
        font-family: 'Montserrat', sans-serif;
    }
    
    .register-footer a {
        color: var(--main-color);
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .register-footer a:hover {
        color: var(--secondary-color);
        text-decoration: underline;
    }
    
    /* Адаптивность */
    @media (max-width: 576px) {
        .register-card {
            padding: 1.5rem;
        }
        
        .register-title {
            font-size: 2rem;
        }
    }
</style>

<div class="register-page">
    <div class="register-card">
        <h1 class="register-title">Регистрация</h1>

        <?php $form = ActiveForm::begin([
            'id' => 'register-form',
            'enableAjaxValidation' => true, // Включаем AJAX-валидацию для всей формы
            'validateOnBlur' => true, // Валидация при потере фокуса
            'validateOnChange' => true, // Валидация при изменении
            'validationUrl' => ['/user/validate'], // URL для AJAX-валидации
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'form-label'],
                'inputOptions' => ['class' => 'form-control'],
                'errorOptions' => ['class' => 'invalid-feedback'],
            ],
        ]); ?>

        <?= $form->field($model, 'username', ['enableAjaxValidation' => true])->textInput([
            'autofocus' => true,
            'placeholder' => 'Придумайте логин',
        ]) ?>

        <?= $form->field($model, 'email', ['enableAjaxValidation' => true])->textInput([
            'placeholder' => 'Ваш email',
            'type' => 'email'
        ]) ?>

        <?= $form->field($model, 'fio')->textInput([
            'placeholder' => 'Ваше полное имя',
        ]) ?>

        <div class="password-field">
            <?= $form->field($model, 'password')->passwordInput([
                'placeholder' => 'Придумайте пароль',
                'id' => 'password-input'
            ]) ?>
            <i class="fas fa-eye password-toggle" id="togglePassword"></i>
        </div>

        <div class="password-field">
            <?= $form->field($model, 'check_password')->passwordInput([
                'placeholder' => 'Повторите пароль',
                'id' => 'confirm-password-input'
            ]) ?>
            <i class="fas fa-eye password-toggle" id="toggleConfirmPassword"></i>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Зарегистрироваться', [
                'class' => 'btn btn-register',
                'name' => 'register-button',
            ]) ?>
        </div>

        <div class="register-footer">
            Уже есть аккаунт? <?= Html::a('Войдите', ['/site/login']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
$this->registerJs(<<<JS
    // Переключение видимости пароля
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password-input');
    
    const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
    const confirmPassword = document.querySelector('#confirm-password-input');
    
    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
    
    toggleConfirmPassword.addEventListener('click', function() {
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
    
    // AJAX-валидация при потере фокуса
    $('#register-form').on('blur', 'input', function() {
        $(this).closest('form').yiiActiveForm('validateAttribute', $(this).attr('id'));
    });
JS
);
?>