<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Catergory $model */

$this->title = 'Create Catergory';
$this->params['breadcrumbs'][] = ['label' => 'Catergories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catergory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
