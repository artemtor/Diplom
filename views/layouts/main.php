<?php
/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use app\models\Notification;

$unreadCount = Notification::getUnreadCount();
$notifications = Notification::getRecentNotifications();
AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php $this->registerCssFile('https://fonts.googleapis.com/css2?family=Caveat:wght@400;700&family=Marck+Script&family=Montserrat:wght@300;400;600&family=Pattaya&display=swap'); ?>
    <style>
        :root {
            --main-color: #8b5e3c;
            --secondary-color: #5a3e36;
            --accent-color: #d4a373;
            --light-bg: #fffaf0;
            --text-color: #5a3e36;
            --header-height: 80px;
            --transition: all 0.3s ease;
        }
        
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: var(--light-bg);
        }
        
        .custom-header {
            background: linear-gradient(135deg, var(--main-color), var(--secondary-color));
            height: var(--header-height);
            box-shadow: 0 4px 20px rgba(139, 94, 60, 0.2);
            transition: var(--transition);
            z-index: 1000;
            width: 100%;
        }
        
        .custom-header.scrolled {
            height: 70px;
            background: linear-gradient(135deg, var(--main-color), var(--secondary-color));
            backdrop-filter: blur(10px);
        }
        
        .navbar-brand {
            font-family: 'Pattaya', sans-serif;
            font-size: 1.8rem;
            color: white !important;
            display: flex;
            align-items: center;
            transition: var(--transition);
        }
        
        .navbar-brand:hover {
            transform: scale(1.05);
        }
        
        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }
        
        .navbar-nav {
            gap: 1rem;
        }
        
        .nav-link {
            font-family: 'Pattaya', sans-serif;
            font-size: 1.1rem;
            color: white !important;
            position: relative;
            padding: 0.5rem 1rem !important;
            transition: var(--transition);
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--accent-color);
            transition: var(--transition);
            transform: translateX(-50%);
        }
        
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 80%;
        }
        
        .nav-link:hover {
            transform: translateY(-3px);
        }
        
        .logout {
            background: none !important;
            border: none;
            font-family: 'Pattaya', sans-serif !important;
        }
        
        .logout:hover {
            color: var(--accent-color) !important;
        }
        
        .navbar-toggler {
            border: none;
            color: white !important;
            font-size: 1.5rem;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }
        
        /* Адаптивность */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: rgba(139, 94, 60, 0.95);
                backdrop-filter: blur(10px);
                padding: 1rem;
                border-radius: 0 0 10px 10px;
                box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            }
            
            .nav-link {
                padding: 0.8rem 0 !important;
                border-bottom: 1px solid rgba(255,255,255,0.1);
            }
            
            .nav-link:hover::after {
                display: none;
            }
        }
        
        /* Основное содержимое */
        #main {
            flex: 1;
            width: 100%;
        }
        
        .container-full {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        
        /* Футер */
        .custom-footer {
            background: linear-gradient(135deg, var(--main-color), var(--secondary-color));
            color: white;
            padding: 1.5rem 0;
            width: 100%;
        }
        
        .social-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .social-link {
            color: white;
            font-size: 1.5rem;
            transition: var(--transition);
        }

        .social-link:hover {
            color: var(--accent-color);
            transform: translateY(-3px);
        }
        
        .text-muted {
            color: rgba(255,255,255,0.7) !important;
        }
    </style>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header" class="custom-header fixed-top">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/image/logo2.png', ['alt' => 'Логотип','style' => 'height: 60px;']) ,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-expand-lg navbar-dark py-2',
        ],
        'containerOptions' => ['class' => 'container-fluid'],
    ]);
    
    $items = [];
    if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin()) { 
     
        $items[] = ['label' => 'Каталог', 'url' => ['/product/catalog'], 'linkOptions' => ['class' => 'nav-link']];
        $items[] = ['label' => 'О бабушке', 'url' => ['/site/about'], 'linkOptions' => ['class' => 'nav-link']];
    }
    
    if (Yii::$app->user->isGuest) {
        $items[] = ['label' => 'Регистрация', 'url' => ['/user/create'], 'linkOptions' => ['class' => 'nav-link']];
        $items[] = ['label' => 'Авторизация', 'url' => ['/site/login'], 'linkOptions' => ['class' => 'nav-link']];
    } elseif (Yii::$app->user->identity->isAdmin()) {
        $items[] = ['label' => 'Панель администратора', 'url' => ['/admin/index'], 'linkOptions' => ['class' => 'nav-link']];
        $items[] = [
            'label' => '🔔 Уведомления' . ($unreadCount > 0 ? ' <span class="badge bg-danger">' . $unreadCount . '</span>' : ''),
            'url' => ['/notification/index'],
            'encode' => false,
            'linkOptions' => ['class' => 'nav-link']
        ];
    } else { 
        $items[] = ['label' => 'Корзина', 'url' => ['/cart/index'], 'linkOptions' => ['class' => 'nav-link']];
        $items[] = ['label' => 'Заказы', 'url' => ['/order/index'], 'linkOptions' => ['class' => 'nav-link']];
    }
    
    if (!Yii::$app->user->isGuest) { 
        $items[] = '<li class="nav-item">'
        . Html::beginForm(['/site/logout'])
        . Html::submitButton(
            'Выход (' . Yii::$app->user->identity->username . ')',
            ['class' => 'nav-link logout']
        )
        . Html::endForm()
        . '</li>';
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto'],
        'items' => $items
    ]);
    
    NavBar::end();
    ?>
</header>
<?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()): ?>
    <?php 
    $unreadCount = \app\models\Notification::getUnreadCount();
    $notifications = \app\models\Notification::getRecentNotifications();
    ?>
    
    <li class="nav-item dropdown notifications-menu">
        <a href="#" class="nav-link" data-toggle="dropdown">
            <i class="far fa-bell"></i>
            <?php if ($unreadCount > 0): ?>
                <span class="badge badge-warning navbar-badge"><?= $unreadCount ?></span>
            <?php endif; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">
                Новых уведомлений: <?= $unreadCount ?>
            </span>
            <div class="dropdown-divider"></div>
            
            <?php if (!empty($notifications)): ?>
                <?php foreach ($notifications as $notification): ?>
                    <a href="<?= \yii\helpers\Url::to(['order/view', 'id' => str_replace('order_', '', $notification->key)]) ?>" 
                       class="dropdown-item <?= $notification->read ? '' : 'font-weight-bold' ?>">
                        <i class="fas fa-shopping-cart mr-2"></i> <?= \yii\helpers\Html::encode($notification->message) ?>
                        <span class="float-right text-muted text-sm">
                            <?= Yii::$app->formatter->asRelativeTime($notification->created_at) ?>
                        </span>
                    </a>
                    <div class="dropdown-divider"></div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="dropdown-item text-muted">Нет уведомлений</div>
                <div class="dropdown-divider"></div>
            <?php endif; ?>
            
            <a href="<?= \yii\helpers\Url::to(['order/index']) ?>" class="dropdown-item dropdown-footer">
                <i class="fas fa-list"></i> Все уведомления
            </a>
        </div>
    </li>
<?php endif; ?>
<main id="main" class="flex-shrink-0" role="main">
    <div class="container-fluid" style="padding-top: calc(var(--header-height) + 20px);">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

</main>

<footer id="footer" class="custom-footer mt-auto">
    <div class="container"> 
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; Магазин вязаных изделий <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end">Сделано с любовью</div>
        </div>
        <div class="social-links">
            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
            <a href="#" class="social-link"><i class="fab fa-vk"></i></a>
            <a href="#" class="social-link"><i class="fab fa-telegram"></i></a>
            <a href="#" class="social-link"><i class="fab fa-whatsapp"></i></a>
        </div>
    </div>
</footer>

<?php $this->registerJs(<<<JS
    window.addEventListener('scroll', function() {
        const header = document.querySelector('.custom-header');
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
JS); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>