<div class="chart-container">
    <canvas id="monthlyChart"></canvas>
</div>

<?php
$js = <<<JS
const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
const monthlyChart = new Chart(monthlyCtx, {
    type: 'bar',
    data: {
        labels: $data['labels'],
        datasets: [{
            label: 'Количество заказов',
            data: $data['values'],
            backgroundColor: 'rgba(90, 62, 54, 0.7)',
            borderColor: 'rgba(90, 62, 54, 1)',
            borderWidth: 1
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
                    text: 'Месяцы'
                }
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'Количество заказов по месяцам'
            }
        }
    }
});
JS;

$this->registerJs($js);
?>