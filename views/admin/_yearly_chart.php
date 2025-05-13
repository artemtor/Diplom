<div class="chart-container">
    <canvas id="yearlyChart"></canvas>
</div>

<?php
$labels = json_encode($data['labels']);
$values = json_encode($data['values']);

$js = <<<JS
const yearlyCtx = document.getElementById('yearlyChart').getContext('2d');
const yearlyChart = new Chart(yearlyCtx, {
    type: 'line',
    data: {
        labels: $labels,
        datasets: [{
            label: 'Количество заказов',
            data: $values,
            backgroundColor: 'rgba(139, 94, 60, 0.2)',
            borderColor: 'rgba(139, 94, 60, 1)',
            borderWidth: 2,
            tension: 0.4,
            fill: true,
            pointBackgroundColor: 'rgba(90, 62, 54, 1)',
            pointRadius: 5,
            pointHoverRadius: 7
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
                    text: 'Количество заказов'
                },
                grid: {
                    color: 'rgba(0, 0, 0, 0.05)'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Годы'
                },
                grid: {
                    color: 'rgba(0, 0, 0, 0.05)'
                }
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'Количество заказов по годам',
                font: {
                    size: 16
                }
            },
            legend: {
                position: 'top',
                labels: {
                    boxWidth: 12,
                    padding: 20
                }
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
                padding: 12,
                cornerRadius: 6
            }
        }
    }
});
JS;

$this->registerJs($js);
?>