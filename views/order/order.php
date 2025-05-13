<?php
use yii\web\View;

/* @var $this View */
/* @var $chartData array */
/* @var $diagnostics array */
/* @var $hasData bool */

// Защита от неопределенных переменных
$chartData = $chartData ?? [
    'labels' => ['Январь','Февраль','Март','Апрель','Май','Июнь',
                'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
    'values' => array_fill(0, 12, 0)
];

$diagnostics = $diagnostics ?? [
    'table_exists' => false,
    'has_date_column' => false,
    'total_orders' => 0,
    'orders_2025_count' => 0,
    'sample_dates' => []
];
$hasData = $hasData ?? false;

$this->title = 'Статистика заказов';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('https://cdn.jsdelivr.net/npm/chart.js', ['position' => View::POS_HEAD]);
?>

<div class="order-statistics">
    <h1><?= $this->title ?></h1>
    
    <!-- Диагностическая панель -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Диагностика системы</h4>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <tr>
                    <td>Таблица 'order' существует:</td>
                    <td><strong><?= $diagnostics['table_exists'] ? 'Да' : 'Нет' ?></strong></td>
                </tr>
                <tr>
                    <td>Поле 'date' существует:</td>
                    <td><strong><?= $diagnostics['has_date_column'] ? 'Да' : 'Нет' ?></strong></td>
                </tr>
                <tr>
                    <td>Всего заказов в БД:</td>
                    <td><strong><?= $diagnostics['total_orders'] ?></strong></td>
                </tr>
                <tr>
                    <td>Заказов за 2025 год:</td>
                    <td><strong><?= $diagnostics['orders_2025_count'] ?></strong></td>
                </tr>
            </table>
            
            <?php if (!empty($diagnostics['sample_dates'])): ?>
            <h5>Последние 5 дат в БД:</h5>
            <ul>
                <?php foreach ($diagnostics['sample_dates'] as $order): ?>
                <li><?= $order->date ?> (Год: <?= date('Y', strtotime($order->date)) ?>)</li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- График -->
    <div class="chart-container" style="max-width: 800px; margin: 30px auto;">
        <canvas id="orderChart" height="400"></canvas>
    </div>
    
    <!-- JavaScript для графика -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('orderChart');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($chartData['labels']) ?>,
                datasets: [{
                    label: 'Количество заказов',
                    data: <?= json_encode($chartData['values']) ?>,
                    backgroundColor: 'rgba(90, 62, 54, 0.7)',
                    borderColor: 'rgba(90, 62, 54, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    });
    </script>
</div>