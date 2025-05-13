<?php
use app\models\Catergory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CatergorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;

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
    .grid-view a {
    color: var(--light-bg); 
    text-decoration: none;
    font-weight: 500;
}

.grid-view a:hover {
    color: var(--accent-color); 
    text-decoration: underline;
}
    body {
        background-color: var(--light-bg);
        font-family: 'Montserrat', sans-serif;
    }
    
    .categories-container {
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
    
    .create-btn {
        display: inline-block;
        background: var(--main-color);
        color: white;
        padding: 0.8rem 2rem;
        border-radius: 30px;
        font-family: 'Caveat', cursive;
        font-size: 1.5rem;
        text-decoration: none;
        margin-bottom: 2rem;
        transition: var(--transition);
        box-shadow: var(--shadow);
        border: none;
        cursor: pointer;
    }
    
    .create-btn:hover {
        background: var(--secondary-color);
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(139, 94, 60, 0.25);
    }
    
    .create-btn i {
        margin-right: 0.5rem;
    }
    
    .grid-view-container {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        padding: 2rem;
        overflow: hidden;
        animation: fadeIn 0.5s forwards;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .table th {
        background: linear-gradient(135deg, var(--main-color), var(--secondary-color));
        color: white;
        padding: 1rem;
        text-align: left;
        font-weight: 600;
    }
    
    .table td {
        padding: 1rem;
        border-bottom: 1px solid rgba(139, 94, 60, 0.1);
        color: var(--text-color);
    }
    
    .table tr:last-child td {
        border-bottom: none;
    }
    
    .table tr:hover td {
        background-color: rgba(212, 163, 115, 0.05);
    }
    
    .action-column {
        white-space: nowrap;
        text-align: center;
    }
    
    .action-column a {
        display: inline-block;
        width: 36px;
        height: 36px;
        line-height: 36px;
        text-align: center;
        border-radius: 50%;
        margin: 0 0.2rem;
        color: white;
        transition: var(--transition);
    }
    
    .action-column a.view {
        background-color: var(--main-color);
    }
    
    .action-column a.update {
        background-color: var(--accent-color);
    }
    
    .action-column a.delete {
        background-color: #dc3545;
    }
    
    .action-column a:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .empty-text {
        text-align: center;
        font-size: 1.2rem;
        color: var(--text-color);
        padding: 2rem;
    }
    
    .empty-icon {
        text-align: center;
        font-size: 3rem;
        color: var(--accent-color);
        margin-bottom: 1rem;
    }
</style>

<div class="categories-container">
    <h1 class="page-title animate__animated animate__fadeIn"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> Создать категорию', ['create'], ['class' => 'create-btn animate__animated animate__pulse']) ?>
    </p>

    <?php if ($dataProvider->getCount() > 0): ?>
        <div class="grid-view-container">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table'],
                'columns' => [
                    [
                        'attribute' => 'id',
                        'headerOptions' => ['style' => 'width: 80px;'],
                        'contentOptions' => ['style' => 'font-weight: 600;']
                    ],
                    [
                        'attribute' => 'name',
                        'contentOptions' => ['style' => 'font-family: "Caveat", cursive; font-size: 1.3rem;']
                    ],
                    [
                        'class' => ActionColumn::className(),
                        'header' => 'Действия',
                        'headerOptions' => ['style' => 'width: 120px; text-align: center;'],
                        'contentOptions' => ['class' => 'action-column'],
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url) {
                                return Html::a('<i class="fas fa-eye"></i>', $url, [
                                    'class' => 'view',
                                    'title' => 'Просмотреть'
                                ]);
                            },
                            'update' => function ($url) {
                                return Html::a('<i class="fas fa-pencil-alt"></i>', $url, [
                                    'class' => 'update',
                                    'title' => 'Редактировать'
                                ]);
                            },
                            'delete' => function ($url) {
                                return Html::a('<i class="fas fa-trash"></i>', $url, [
                                    'class' => 'delete',
                                    'title' => 'Удалить',
                                    'data' => [
                                        'confirm' => 'Вы уверены, что хотите удалить эту категорию?',
                                        'method' => 'post',
                                    ]
                                ]);
                            },
                        ],
                        'urlCreator' => function ($action, Catergory $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    <?php else: ?>
        <div class="empty-orders animate__animated animate__fadeIn">
            <div class="empty-icon">
                <i class="fas fa-folder-open"></i>
            </div>
            <div class="empty-text">Категории не найдены</div>
        </div>
    <?php endif; ?>
</div>

<?php
$this->registerJs(<<<JS
    $(document).ready(function() {
        // Анимация при наведении на кнопку создания
        $('.create-btn').hover(
            function() {
                $(this).addClass('animate__animated animate__pulse');
            },
            function() {
                $(this).removeClass('animate__animated animate__pulse');
            }
        );
    });
JS
);
?>