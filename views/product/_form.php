<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Catergory;
/** @var yii\web\View $this */
/** @var app\models\Product $model */
/** @var yii\bootstrap5\ActiveForm $form */
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
    
    .product-form-container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        border: 1px solid rgba(139, 94, 60, 0.1);
    }
    
    .form-title {
        font-family: 'Marck Script', cursive;
        font-size: 2.5rem;
        color: var(--main-color);
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
    }
    
    .form-title::after {
        content: '';
        display: block;
        width: 100px;
        height: 3px;
        background: linear-gradient(90deg, var(--main-color), var(--accent-color));
        margin: 0.5rem auto 0;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        color: var(--secondary-color);
        margin-bottom: 0.5rem;
    }
    
    .form-control {
        border: 1px solid rgba(139, 94, 60, 0.3);
        border-radius: var(--border-radius);
        padding: 12px 15px;
        font-size: 1rem;
        transition: var(--transition);
        background-color: var(--light-bg);
    }
    
    .form-control:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 0.25rem rgba(212, 163, 115, 0.25);
        background-color: white;
    }
    
    .btn-submit {
        background-color: var(--main-color);
        color: white;
        border: none;
        border-radius: var(--border-radius);
        padding: 12px 25px;
        font-size: 1.2rem;
        font-family: 'Caveat', cursive;
        transition: var(--transition);
        cursor: pointer;
        display: block;
        width: 100%;
        max-width: 200px;
        margin: 2rem auto 0;
        box-shadow: var(--shadow);
    }
    
    .btn-submit:hover {
        background-color: var(--secondary-color);
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(139, 94, 60, 0.25);
    }
    
    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }
    
    .file-input-wrapper input[type=file] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
    }
    
    .file-input-label {
        border: 2px dashed var(--main-color);
        border-radius: var(--border-radius);
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: var(--transition);
        background-color: rgba(212, 163, 115, 0.1);
        display: block;
    }
    
    .file-input-label:hover {
        background-color: rgba(212, 163, 115, 0.2);
    }
    
    .file-input-icon {
        font-size: 2rem;
        color: var(--main-color);
        margin-bottom: 1rem;
    }
    
    @media (max-width: 768px) {
        .product-form-container {
            padding: 1.5rem;
        }
        
        .form-title {
            font-size: 2rem;
        }
    }
</style>

<div class="product-form-container">
    <h1 class="form-title"><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="form-group">
    <?= $form->field($model, 'photo')->fileInput() ?>
<?php if ($model->photo): ?>
    <div class="current-photo">
        <p>Текущее фото:</p>
        <img src="<?= Yii::getAlias('@web/'.$model->photo) ?>" style="max-width: 200px;">
        <p>Оставьте поле пустым, чтобы сохранить текущее фото</p>
    </div>
<?php endif; ?>

    <?= $form->field($model, 'name', [
        'template' => "{label}\n{input}\n{error}",
        'labelOptions' => ['class' => 'form-label'],
        'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Название товара']
    ]) ?>

    <?= $form->field($model, 'price', [
        'template' => "{label}\n{input}\n{error}",
        'labelOptions' => ['class' => 'form-label'],
        'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Цена в рублях']
    ]) ?>

    <?= $form->field($model, 'color', [
        'template' => "{label}\n{input}\n{error}",
        'labelOptions' => ['class' => 'form-label'],
        'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Цвет товара']
    ]) ?>

<?= $form->field($model, 'category_id')->dropDownList(
                ArrayHelper::map(Catergory::find()->all(), 'id', 'name'),
                [
                    'class' => 'form-control',
                    'prompt' => 'Выберите категорию'
                ]
            ) ?>

    <?= Html::submitButton('Сохранить', ['class' => 'btn-submit']) ?>

    <?php ActiveForm::end(); ?>
</div>

<?php $this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'); ?>

<script>
document.getElementById('file-input').addEventListener('change', function(e) {
    const fileName = e.target.files[0]?.name || 'Файл не выбран';
    const label = document.querySelector('.file-input-label div:first-of-type');
    label.textContent = fileName;
});
</script>