<?php
use app\models\Order;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap5\Tabs;

/** @var yii\web\View $this */
$this->title = 'Статистика заказов';
$this->params['breadcrumbs'][] = $this->title;

// Подключаем Chart.js
$this->registerJsFile('https://cdn.jsdelivr.net/npm/chart.js', ['position' => View::POS_HEAD]);

// Получаем данные для графиков
$monthlyData = Order::getMonthlyOrderCount();
$yearlyData = Order::getYearlyOrderCount();
?>

<div class="order-statistics">
    <h1 class="text-center mb-4"><?= Html::encode($this->title) ?></h1>

    <?= Tabs::widget([
        'items' => [
            [
                'label' => 'По месяцам',
                'content' => $this->render('_monthly_chart', ['data' => $monthlyData]),
                'active' => true
            ],
            [
                'label' => 'По годам',
                'content' => $this->render('_yearly_chart', ['data' => $yearlyData])
            ],
        ],
    ]) ?>
</div>

<?php
// Стили для страницы
$css = <<<CSS
.order-statistics {
    background-color: #f8f9fa;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.chart-container {
    position: relative;
    height: 400px;
    margin: 2rem auto;
    padding: 1rem;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.tab-content {
    background: white;
    padding: 1.5rem;
    border-radius: 0 0 8px 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.nav-tabs {
    border-bottom: 2px solid #dee2e6;
}

.nav-tabs .nav-link {
    font-weight: 500;
    color: #6c757d;
    border: none;
    padding: 0.75rem 1.5rem;
}

.nav-tabs .nav-link.active {
    color: #5a3e36;
    background-color: #fff;
    border-bottom: 3px solid #5a3e36;
}

.nav-tabs .nav-link:hover {
    color: #5a3e36;
    border-color: transparent;
}
CSS;

$this->registerCss($css);
?>