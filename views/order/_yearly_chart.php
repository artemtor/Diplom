<div class="chart-container">
    <canvas id="yearlyChart"></canvas>
</div>

<?php
$js = <<<JS
const yearlyCtx = document.getElementById('yearlyChart').getContext('2d');
const yearlyChart = new Chart(yearlyCtx, {
    type: 'line',
    data: {
        labels: $data['labels'],
        datasets: [{
            label: 'Количество заказов',
            data: $data['values'],
            backgroundColor: 'rgba(139, 94, 60, 0.2)',
            borderColor: 'rgba(139, 94, 60, 1)',
            borderWidth: 2,
            tension: 0.4,
            fill: true
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
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Годы'
                }
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'Количество заказов по годам'
            }
        }
    }
});
JS;

$this->registerJs($js);
?>