<div class="chart-container">
    <div class="chart-header">
        <h2 class="chart-title">Количество заказов по месяцам</h2>
    </div>
    <canvas id="monthlyChart"></canvas>
</div>

<?php
$labels = json_encode($data['labels']);
$values = json_encode($data['values']);

$js = <<<JS
const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
const monthlyChart = new Chart(monthlyCtx, {
    type: 'bar',
    data: {
        labels: $labels,
        datasets: [{
            label: 'Количество заказов',
            data: $values,
            backgroundColor: 'rgba(90, 62, 54, 0.7)',
            borderColor: 'rgba(90, 62, 54, 1)',
            borderWidth: 1,
            borderRadius: 4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Количество заказов',
                    color: '#5a3e36'
                },
                grid: {
                    color: 'rgba(90, 62, 54, 0.1)'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Месяцы',
                    color: '#5a3e36'
                },
                grid: {
                    display: false
                }
            }
        },
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                backgroundColor: 'rgba(90, 62, 54, 0.9)',
                titleFont: {
                    size: 14,
                    weight: 'bold'
                },
                bodyFont: {
                    size: 12
                },
                padding: 10,
                cornerRadius: 6
            }
        }
    }
});
JS;

$this->registerJs($js);
?>