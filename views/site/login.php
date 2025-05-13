<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    :root {
        --main-color: #7D6B5E;
        --secondary-color: #5a3e36;
        --accent-color: #d4a373;
        --light-bg: #fffaf0;
        --text-color: #5a3e36;
    }
    
    .login-page {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: var(--light-bg);
        padding: 20px;
    }
    
    .login-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(139, 94, 60, 0.15);
        padding: 2.5rem;
        width: 100%;
        max-width: 450px;
        position: relative;
        overflow: hidden;
    }
    
    .login-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--main-color), var(--accent-color));
    }
    
    .login-title {
        font-family: 'Marck Script', cursive;
        font-size: 2.5rem;
        color: var(--main-color);
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .login-title::after {
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
    
    .btn-login {
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
    
    .btn-login:hover {
        background-color: var(--secondary-color);
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(139, 94, 60, 0.2);
    }
    .btn-primary-login {
        background-color: var(--main-color);
        color: white;
    }
    
    .custom-checkbox .custom-control-label::before {
        border: 1px solid var(--main-color);
    }
    
    .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
        background-color: var(--main-color);
        border-color: var(--main-color);
    }
    
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.9rem;
    }
    
    .login-footer {
        text-align: center;
        margin-top: 1.5rem;
        color: var(--text-color);
        font-family: 'Montserrat', sans-serif;
    }
    
    .login-footer a {
        color: var(--main-color);
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .login-footer a:hover {
        color: var(--secondary-color);
        text-decoration: underline;
    }
</style>

<div class="login-page">
    <div class="login-card">
        <h1 class="login-title"><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'form-label'],
                'inputOptions' => ['class' => 'form-control'],
                'errorOptions' => ['class' => 'invalid-feedback'],
            ],
        ]); ?>

        <?= $form->field($model, 'username')->textInput([
            'autofocus' => true,
            'placeholder' => 'Ваше имя пользователя',
        ]) ?>

        <?= $form->field($model, 'password')->passwordInput([
            'placeholder' => 'Ваш пароль',
        ]) ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"custom-control custom-checkbox mb-3\">{input} {label}</div>",
            'labelOptions' => ['class' => 'custom-control-label'],
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Войти', [
                'class' => 'btn btn-login btn-primary-login',
                'name' => 'login-button',
            ]) ?>
        </div>

        <div class="login-footer">
            Нет аккаунта? <?= Html::a('Зарегистрируйтесь', ['/user/create']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>