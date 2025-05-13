<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\OrderStatus;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Редактирование заказа #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('https://fonts.googleapis.com/css2?family=Caveat:wght@400;700&family=Marck+Script&family=Montserrat:wght@300;400;600&display=swap');
?>

<style>
    :root {
        --main-color: #8b5e3c;
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
    
    .status-form-container {
        max-width: 700px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        border: 1px solid rgba(139, 94, 60, 0.1);
    }
    
    .status-title {
        font-family: 'Marck Script', cursive;
        font-size: 2.5rem;
        color: var(--main-color);
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
    }
    
    .status-title::after {
        content: '';
        display: block;
        width: 100px;
        height: 3px;
        background: linear-gradient(90deg, var(--main-color), var(--accent-color));
        margin: 0.5rem auto 0;
    }
    
    .order-info-card {
        background-color: var(--light-bg);
        padding: 1.5rem;
        border-radius: var(--border-radius);
        margin-bottom: 2rem;
        border: 1px dashed var(--main-color);
    }
    
    .info-row {
        display: flex;
        margin-bottom: 1rem;
        align-items: center;
    }
    
    .info-label {
        font-weight: 600;
        min-width: 150px;
        color: var(--secondary-color);
    }
    
    .info-value {
        font-family: 'Caveat', cursive;
        font-size: 1.2rem;
    }
    
    .current-status {
        display: inline-block;
        padding: 0.3rem 1rem;
        border-radius: 20px;
        background-color: var(--accent-color);
        color: white;
        font-weight: 600;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        font-weight: 600;
        color: var(--secondary-color);
        margin-bottom: 0.5rem;
        display: block;
    }
    
    .form-control {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1px solid rgba(139, 94, 60, 0.3);
        border-radius: var(--border-radius);
        font-family: 'Montserrat', sans-serif;
        transition: var(--transition);
        background-color: white;
    }
    
    .form-control:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 0.25rem rgba(212, 163, 115, 0.25);
        outline: none;
    }
    
    .btn-submit {
        background-color: var(--main-color);
        color: white;
        border: none;
        padding: 0.8rem 2rem;
        font-size: 1.2rem;
        font-family: 'Caveat', cursive;
        border-radius: var(--border-radius);
        cursor: pointer;
        transition: var(--transition);
        display: block;
        width: 100%;
        max-width: 250px;
        margin: 1.5rem auto 0;
        box-shadow: var(--shadow);
    }
    
    .btn-submit:hover {
        background-color: var(--secondary-color);
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(139, 94, 60, 0.25);
    }
    
    @media (max-width: 768px) {
        .status-form-container {
            padding: 1.5rem;
        }
        
        .status-title {
            font-size: 2rem;
        }
        
        .info-row {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .info-label {
            margin-bottom: 0.3rem;
        }
    }
</style>

<div class="status-form-container">
    <h1 class="status-title"><?= Html::encode($this->title) ?></h1>
    
    <div class="order-info-card">
        <div class="info-row">
            <div class="info-label">Номер заказа:</div>
            <div class="info-value">#<?= $model->id ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Дата создания:</div>
            <div class="info-value"><?= Yii::$app->formatter->asDatetime($model->date, 'php:d.m.Y H:i') ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Текущий статус:</div>
            <div class="info-value">
                <span class="current-status"><?= $model->status->name ?? 'Не указан' ?></span>
            </div>
        </div>
    </div>

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="form-group">
        <?= $form->field($model, 'status_id', [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'form-label'],
            'inputOptions' => ['class' => 'form-control']
        ])->dropDownList(
            ArrayHelper::map(OrderStatus::find()->all(), 'id', 'name'),
            ['prompt' => 'Выберите новый статус']
        )->label('Изменить статус') ?>
    </div>
    
    <?= Html::submitButton('Обновить статус', ['class' => 'btn-submit']) ?>
    
    <?php ActiveForm::end(); ?>
</div>