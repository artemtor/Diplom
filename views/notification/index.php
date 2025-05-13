<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Notification[] $notifications */

$this->title = 'Уведомления';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('https://fonts.googleapis.com/css2?family=Caveat:wght@400;700&family=Marck+Script&family=Montserrat:wght@300;400;600&display=swap');
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
    
    .notifications-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .notification-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        margin-bottom: 1.5rem;
        overflow: hidden;
        transition: var(--transition);
        transform: translateY(20px);
        opacity: 0;
        animation: fadeInUp 0.5s forwards;
        margin-top: 40px;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .notification-header {
        background: linear-gradient(135deg, var(--main-color), var(--secondary-color));
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .notification-type {
        font-family: 'Caveat', cursive;
        font-size: 1.5rem;
        color: white;
    }

    .notification-date {
        color: rgba(255,255,255,0.8);
        font-size: 0.9rem;
    }

    .notification-body {
        padding: 1.5rem;
        position: relative;
    }

    .notification-message {
        font-size: 1.1rem;
        color: var(--text-color);
        margin-bottom: 1rem;
    }

    .notification-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
    }

    .mark-all-btn {
        background: var(--main-color);
        color: white;
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 30px;
        font-family: 'Caveat', cursive;
        font-size: 1.3rem;
        margin-bottom: 2rem;
        transition: var(--transition);
    }

    .mark-all-btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .empty-notifications {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
    }

    .empty-icon {
        font-size: 4rem;
        color: var(--accent-color);
        margin-bottom: 1.5rem;
    }

    .empty-text {
        font-family: 'Marck Script', cursive;
        font-size: 2rem;
        color: var(--main-color);
    }
</style>

<div class="notifications-container">
    <h1 class="page-title animate__animated animate__fadeIn"><?= Html::encode($this->title) ?></h1>

    <?= Html::a('Пометить все как прочитанные', ['notification/mark-all-as-read'], [
        'class' => 'mark-all-btn animate__animated animate__pulse'
    ]) ?>

    <?php if (!empty($notifications)): ?>
        <?php foreach ($notifications as $index => $notification): ?>
            <div class="notification-card" style="animation-delay: <?= $index * 0.1 ?>s">
                <div class="notification-header">
                    <div class="notification-type">
                        <?= Html::encode($notification->type) ?>
                    </div>
                    <div class="notification-date">
                        <?= Yii::$app->formatter->asDatetime($notification->created_at) ?>
                    </div>
                </div>
                
                <div class="notification-body">
                    <div class="notification-message">
                        <?= Html::encode($notification->message) ?>
                    </div>
                    
                    <div class="notification-actions">
                        <?php if (!$notification->read): ?>
                            <?= Html::a('Прочитано', ['notification/mark-as-read', 'id' => $notification->id], [
                                'class' => 'action-btn update-btn',
                                'data' => [
                                    'confirm' => 'Пометить уведомление как прочитанное?',
                                    'method' => 'post',
                                ]
                            ]) ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="empty-notifications animate__animated animate__fadeIn">
            <div class="empty-icon">
                <i class="fas fa-bell-slash"></i>
            </div>
            <div class="empty-text">Нет новых уведомлений</div>
        </div>
    <?php endif; ?>
</div>

<?php
$this->registerJs(<<<JS
    $(document).ready(function() {
        $('.action-btn').hover(
            function() {
                $(this).addClass('animate__animated animate__pulse');
            },
            function() {
                $(this).removeClass('animate__animated animate__pulse');
            }
        );
    });
JS);
?>