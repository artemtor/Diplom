<?php
use yii\helpers\Html;
/** @var yii\web\View $this */

$this->title = 'Панель администратора';
$this->registerCssFile('https://fonts.googleapis.com/css2?family=Caveat:wght@400;700&family=Marck+Script&family=Montserrat:wght@300;400;600&display=swap');
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
    
    body {
        background-color: var(--light-bg);
        font-family: 'Montserrat', sans-serif;
    }
    
    .admin-dashboard {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }
    
    .admin-header {
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
    }
    
    .admin-title {
        font-family: 'Marck Script', cursive;
        font-size: 3rem;
        color: var(--main-color);
        margin-bottom: 1.5rem;
        position: relative;
        display: inline-block;
    }
    
    .admin-title::before,
    .admin-title::after {
        content: '';
        position: absolute;
        top: 50%;
        width: 50px;
        height: 2px;
        background: linear-gradient(90deg, var(--main-color), var(--accent-color));
    }
    
    .admin-title::before {
        left: -60px;
    }
    
    .admin-title::after {
        right: -60px;
    }
    
    .admin-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }
    
    .admin-card {
        background: white;
        border-radius: var(--border-radius);
        padding: 2rem;
        box-shadow: var(--shadow);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(139, 94, 60, 0.1);
    }
    
    .admin-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--main-color), var(--accent-color));
    }
    
    .admin-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(139, 94, 60, 0.25);
    }
    
    .card-icon {
        font-size: 2.5rem;
        color: var(--accent-color);
        margin-bottom: 1.5rem;
        transition: var(--transition);
    }
    
    .admin-card:hover .card-icon {
        transform: scale(1.1);
    }
    
    .card-title {
        font-family: 'Caveat', cursive;
        font-size: 1.8rem;
        color: var(--secondary-color);
        margin-bottom: 1rem;
    }
    
    .card-desc {
        color: var(--text-color);
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }
    
    .admin-btn {
        display: inline-block;
        padding: 0.7rem 1.5rem;
        border-radius: 30px;
        font-family: 'Caveat', cursive;
        font-size: 1.2rem;
        text-decoration: none;
        transition: var(--transition);
        background-color: var(--main-color);
        color: white;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(125, 107, 94, 0.2);
    }
    
    .admin-btn:hover {
        background-color: var(--secondary-color);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(125, 107, 94, 0.3);
    }
    
    @media (max-width: 768px) {
        .admin-title {
            font-size: 2.2rem;
        }
        
        .admin-title::before,
        .admin-title::after {
            width: 30px;
        }
        
        .admin-title::before {
            left: -40px;
        }
        
        .admin-title::after {
            right: -40px;
        }
    }
    
    @media (max-width: 576px) {
        .admin-title::before,
        .admin-title::after {
            display: none;
        }
    }
</style>

<div class="admin-dashboard">
    <div class="admin-header">
        <h1 class="admin-title"><?= Html::encode($this->title) ?></h1>
    </div>
    
    <div class="admin-grid">
        <div class="admin-card">
            <div class="card-icon">
                <i class="fas fa-boxes"></i>
            </div>
            <h3 class="card-title">Товары</h3>
            <p class="card-desc">Управление ассортиментом магазина</p>
            <?= Html::a('Управление', '/product/catalog', ['class' => 'admin-btn']) ?>
        </div>
        
        <div class="admin-card">
            <div class="card-icon">
                <i class="fas fa-plus-square"></i>
            </div>
            <h3 class="card-title">Новый товар</h3>
            <p class="card-desc">Добавление новых позиций в каталог</p>
            <?= Html::a('Создать', '/product/create', ['class' => 'admin-btn']) ?>
        </div>
        
        <div class="admin-card">
            <div class="card-icon">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <h3 class="card-title">Заказы</h3>
            <p class="card-desc">Просмотр и обработка заказов</p>
            <?= Html::a('Просмотреть', '/order/index', ['class' => 'admin-btn']) ?>
        </div>
        
        <div class="admin-card">
            <div class="card-icon">
                <i class="fas fa-tags"></i>
            </div>
            <h3 class="card-title">Категории</h3>
            <p class="card-desc">Управление категориями товаров</p>
            <?= Html::a('Управлять', '/catergory/index', ['class' => 'admin-btn']) ?>
        </div>
        
        <div class="admin-card">
            <div class="card-icon">
                <i class="fas fa-chart-pie"></i>
            </div>
            <h3 class="card-title">Статистика</h3>
            <p class="card-desc">Анализ продаж и активности</p>
            <?= Html::a('Анализировать', '/order/stats', ['class' => 'admin-btn']) ?>
        </div>
    </div>
</div>

<?php $this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'); ?>