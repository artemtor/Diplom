<?php
use yii\web\JsExpression;

$this->title = 'Статистика заказов по месяцам';
$this->registerJsFile('https://cdn.jsdelivr.net/npm/chart.js', ['depends' => [\yii\web\JqueryAsset::class]]);

// Добавляем CSS стили
$this->registerCss("
    .stats-container {
        background-color: var(--light-bg);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        padding: 25px;
        margin-top: 30px;
        transition: var(--transition);
    }
    .stats-title {
        color: var(--secondary-color);
        margin-bottom: 20px;
        font-weight: 600;
        border-bottom: 2px solid var(--accent-color);
        padding-bottom: 10px;
    }
    .stats-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
    }
    .stats-table th {
        background-color: var(--main-color);
        color: white;
        padding: 12px 15px;
        text-align: left;
        font-weight: 500;
    }
    .stats-table td {
        padding: 12px 15px;
        border-bottom: 1px solid rgba(90, 62, 54, 0.1);
        color: var(--text-color);
    }
    .stats-table tr:last-child td {
        border-bottom: none;
    }
    .stats-table tr:hover td {
        background-color: rgba(212, 163, 115, 0.1);
    }
    .stats-table .total-row {
        background-color: rgba(125, 107, 94, 0.1);
        font-weight: 600;
    }
    .revenue-cell {
        color: var(--secondary-color);
        font-weight: 500;
    }
");
?>

<h1><?= $this->title ?></h1>

<canvas id="ordersChart" width="800" height="400"></canvas>

<div class="stats-container">
    <h3 class="stats-title">Финансовая статистика</h3>
    <table class="stats-table">
        <thead>
            <tr>
                <th>Месяц</th>
                <th>Чистая выручка</th>
                <th>Количество заказов</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($labels as $index => $month): ?>
            <tr>
                <td><?= $month ?></td>
                <td class="revenue-cell"><?= number_format($netRevenue[$index], 2, '.', ' ') ?> руб.</td>
                <td><?= $values[$index] ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td>Итого:</td>
                <td class="revenue-cell"><?= number_format(array_sum($netRevenue), 2, '.', ' ') ?> руб.</td>
                <td><?= array_sum($values) ?></td>
            </tr>
        </tbody>
    </table>
</div>

<?php
$js = new JsExpression("
    const ctx = document.getElementById('ordersChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: " . json_encode($labels) . ",
            datasets: [{
                label: 'Количество заказов',
                data: " . json_encode($values) . ",
                backgroundColor: 'rgba(125, 107, 94, 0.7)',
                borderColor: 'rgba(90, 62, 54, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1
                }
            }
        }
    });
");
$this->registerJs($js);
?>