<?php
/** @var yii\web\View $this */
use yii\helpers\Html;
$this->title = 'Магазин вязаных изделий';

// Подключаем стили и скрипты
$this->registerCssFile('https://fonts.googleapis.com/css2?family=Caveat:wght@400;700&family=Marck+Script&family=Montserrat:wght@300;400;600&display=swap');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
?>

<style>
    :root {
        --main-color: #7D6B5E;
        --secondary-color: #5a3e36;
        --accent-color: #d4a373;
        --light-bg: #fffaf0;
        --text-color: #5a3e36;
        --text1-color: #FFFFFF;
        --shadow: 0 4px 20px rgba(139, 94, 60, 0.15);
        --border-radius: 15px;
        --transition: all 0.3s ease;
    }

    body {
        font-family: 'Montserrat', sans-serif;
        background-color: var(--light-bg);
        color: var(--text-color);
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        line-height: 1.6;
    }

    /* Базовые стили для адаптивности */
    .container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
        box-sizing: border-box;
    }

    /* Герой-секция */
    .hero-section {
        background: linear-gradient(rgba(139, 94, 60, 0.3), rgba(90, 62, 54, 0.5));
        background-size: cover;
        background-position: center;
        background-attachment: scroll; /* Изменено для мобильных */
        height: 100vh;
        min-height: 600px; /* Минимальная высота */
        max-height: 1200px; /* Максимальная высота */
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .hero-image {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: translate(-50%, -50%);
        z-index: 1;
    }
    
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(139, 94, 60, 0.3);
        z-index: 2;
    }

    .hero-content {
        z-index: 3;
        opacity: 0;
        transform: translateY(50px);
        animation: fadeInUp 1s forwards 0.5s;
        padding: 0 20px;
        width: 100%;
        box-sizing: border-box;
    }

    .hero-section h1 {
        font-family: 'Marck Script', cursive;
        font-size: 5rem;
        color: white;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .hero-section p {
        font-family: 'Caveat', cursive;
        font-size: 2.5rem;
        color: white;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
        margin-bottom: 2rem;
    }

    .hero-btn {
        font-family: 'Caveat', cursive;
        font-size: 1.5rem;
        padding: 1rem 2.5rem;
        background-color: var(--accent-color);
        color: white;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        transition: var(--transition);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        display: inline-block;
        text-decoration: none;
    }

    .hero-btn:hover {
        background-color: var(--main-color);
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }

    /* О нас */
    .about-section {
        padding: 6rem 2rem;
        background-color: white;
        text-align: center;
    }

    .section-title {
        font-family: 'Marck Script', cursive;
        font-size: 3rem;
        color: var(--main-color);
        margin-bottom: 3rem;
        position: relative;
    }

    .section-title::after {
        content: '';
        display: block;
        width: 100px;
        height: 3px;
        background: linear-gradient(90deg, var(--accent-color), var(--accent-color));
        margin: 1rem auto 0;
    }
    
    .section-title1 {
        font-family: 'Marck Script', cursive;
        font-size: 3rem;
        color: var(--text1-color);
        margin-bottom: 3rem;
        position: relative;
    }

    .section-title1::after {
        content: '';
        display: block;
        width: 100px;
        height: 3px;
        background: linear-gradient(90deg, var(--main-color), var(--accent-color));
        margin: 1rem auto 0;
    }

    .about-content {
        max-width: 800px;
        margin: 0 auto;
        font-size: 1.1rem;
        line-height: 1.8;
    }

    /* Коллекции */
    .collection-section {
        padding: 6rem 2rem;
        background-color: var(--light-bg);
        text-align: center;
    }

    .collection-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .collection-card {
        background: white;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        opacity: 0;
        transform: translateY(30px);
    }

    .collection-card:nth-child(1) {
        animation: fadeInUp 0.8s forwards 0.2s;
    }

    .collection-card:nth-child(2) {
        animation: fadeInUp 0.8s forwards 0.4s;
    }

    .collection-card:nth-child(3) {
        animation: fadeInUp 0.8s forwards 0.6s;
    }

    .collection-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(139, 94, 60, 0.2);
    }

    .collection-img {
        width: 100%;
        height: 350px;
        object-fit: cover;
    }

    .collection-info {
        padding: 1.5rem;
    }

    .collection-title {
        font-family: 'Caveat', cursive;
        font-size: 1.8rem;
        color: var(--main-color);
        margin-bottom: 0.5rem;
    }

    .collection-desc {
        color: var(--secondary-color);
        margin-bottom: 1.5rem;
    }

    .collection-btn {
        font-family: 'Caveat', cursive;
        font-size: 1.2rem;
        padding: 0.5rem 1.5rem;
        background-color: var(--accent-color);
        color: white;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        transition: var(--transition);
    }

    .collection-btn:hover {
        background-color: var(--main-color);
    }

    /* Преимущества */
    .features-section {
        padding: 6rem 2rem;
        background-color: white;
        text-align: center;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 3rem;
        margin-top: 3rem;
    }

    .feature-card {
        opacity: 0;
        transform: translateY(30px);
        padding: 0 15px;
    }

    .feature-card:nth-child(1) {
        animation: fadeInUp 0.8s forwards 0.2s;
    }

    .feature-card:nth-child(2) {
        animation: fadeInUp 0.8s forwards 0.4s;
    }

    .feature-card:nth-child(3) {
        animation: fadeInUp 0.8s forwards 0.6s;
    }

    .feature-card:nth-child(4) {
        animation: fadeInUp 0.8s forwards 0.8s;
    }

    .feature-icon {
        font-size: 3rem;
        color: var(--accent-color);
        margin-bottom: 1.5rem;
    }

    .feature-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--main-color);
    }

    .feature-desc {
        color: var(--secondary-color);
        line-height: 1.6;
    }

    /* Рассылка */
    .newsletter-section {
        padding: 6rem 2rem;
        background: linear-gradient(rgba(139, 94, 60, 0.8), rgba(90, 62, 54, 0.8)),
            url('@web/image/10.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: scroll; /* Изменено для мобильных */
        color: white;
        text-align: center;
        margin-bottom: 20px;
    }

    .newsletter-form {
        max-width: 500px;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1rem;
    }

    .newsletter-input {
        flex: 1;
        min-width: 250px;
        padding: 1rem;
        border: none;
        border-radius: 50px;
        font-size: 1rem;
        width: 100%;
        box-sizing: border-box;
    }

    .newsletter-btn {
        font-family: 'Caveat', cursive;
        font-size: 1.3rem;
        padding: 1rem 2.5rem;
        background-color: var(--accent-color);
        color: white;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        transition: var(--transition);
        width: 100%;
        max-width: 250px;
    }

    .newsletter-btn:hover {
        background-color: var(--main-color);
        transform: translateY(-3px);
    }

    /* Отзывы */
    .testimonials-section {
        padding: 6rem 2rem;
        background-color: var(--light-bg);
        text-align: center;
    }

    .testimonials-slider {
        max-width: 800px;
        margin: 3rem auto 0;
        padding: 0 15px;
    }

    .testimonial-card {
        background: white;
        padding: 2rem;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        margin: 0 1rem;
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 1s forwards;
    }

    .testimonial-text {
        font-style: italic;
        line-height: 1.8;
        margin-bottom: 1.5rem;
        position: relative;
    }

    .testimonial-text::before,
    .testimonial-text::after {
        content: '"';
        font-size: 2rem;
        color: var(--accent-color);
        opacity: 0.5;
    }

    .testimonial-author {
        font-weight: 600;
        color: var(--main-color);
    }

    /* Футер */
    .footer {
        background-color: var(--secondary-color);
        color: white;
        padding: 4rem 2rem;
        text-align: center;
    }

    .footer-logo {
        font-family: 'Marck Script', cursive;
        font-size: 2.5rem;
        color: white;
        margin-bottom: 1.5rem;
    }

    .footer-links {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .footer-link {
        color: white;
        text-decoration: none;
        transition: var(--transition);
    }

    .footer-link:hover {
        color: var(--accent-color);
    }

    .social-links {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        margin-bottom: 2rem;
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

    .copyright {
        opacity: 0.8;
        font-size: 0.9rem;
    }

    /* Анимации */
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Адаптивность */
    @media (max-width: 1200px) {
        .hero-section h1 {
            font-size: 4.5rem;
        }
        
        .hero-section p {
            font-size: 2.2rem;
        }
    }

    @media (max-width: 992px) {
        .hero-section h1 {
            font-size: 4rem;
        }
        
        .hero-section p {
            font-size: 2rem;
        }
        
        .section-title, .section-title1 {
            font-size: 2.8rem;
        }
        
        .collection-img {
            height: 300px;
        }
    }

    @media (max-width: 768px) {
        .hero-section {
            background-attachment: scroll;
            min-height: 500px;
        }
        
        .hero-section h1 {
            font-size: 3.5rem;
        }
        
        .hero-section p {
            font-size: 1.8rem;
        }
        
        .hero-btn {
            font-size: 1.3rem;
            padding: 0.8rem 2rem;
        }
        
        .section-title, .section-title1 {
            font-size: 2.5rem;
        }
        
        .about-content, .feature-desc, .collection-desc, .testimonial-text {
            font-size: 1rem;
        }
        
        .features-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 2rem;
        }
        
        .feature-icon {
            font-size: 2.5rem;
        }
        
        .feature-title {
            font-size: 1.2rem;
        }
    }

    @media (max-width: 576px) {
        .hero-section h1 {
            font-size: 2.8rem;
            margin-bottom: 0.5rem;
        }
        
        .hero-section p {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .section-title, .section-title1 {
            font-size: 2.2rem;
            margin-bottom: 2rem;
        }
        
        .section-title::after, .section-title1::after {
            width: 80px;
            height: 2px;
            margin: 0.5rem auto 0;
        }
        
        .about-section, .collection-section, 
        .features-section, .newsletter-section,
        .testimonials-section {
            padding: 4rem 1.5rem;
        }
        
        .collection-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .collection-img {
            height: 250px;
        }
        
        .features-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        .feature-card {
            max-width: 300px;
            margin: 0 auto;
        }
        
        .newsletter-form {
            flex-direction: column;
            align-items: center;
        }
        
        .newsletter-input, .newsletter-btn {
            width: 100%;
            max-width: none;
        }
        
        .footer {
            padding: 3rem 1.5rem;
        }
        
        .footer-logo {
            font-size: 2rem;
        }
    }

    @media (max-width: 400px) {
        .hero-section h1 {
            font-size: 2.2rem;
        }
        
        .hero-section p {
            font-size: 1.3rem;
        }
        
        .hero-btn {
            font-size: 1.1rem;
            padding: 0.7rem 1.5rem;
        }
        
        .section-title, .section-title1 {
            font-size: 1.8rem;
        }
        
        .collection-title {
            font-size: 1.6rem;
        }
        
        .collection-btn, .newsletter-btn {
            font-size: 1.1rem;
        }
    }

</style>

<div class="site-index">
    <section class="hero-section">
    <?= Html::img('@web/image/10.jpg', [
        'alt' => 'Изображение коллекции Осень-Зима',
        'class' => 'hero-image'
    ]); ?>
     <div class="overlay"></div>
        <div class="hero-content">
            <h1 class="animate__animated animate__fadeInDown">Вязанные изделия </h1>
            <p class="animate__animated animate__fadeIn animate__delay-1s">COLLECTION</p>
            <a href="/product/catalog" class="hero-btn animate__animated animate__fadeInUp animate__delay-2s">В КАТАЛОГ</a>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <h2 class="section-title animate__animated animate__fadeIn">О нашем магазине</h2>
            <div class="about-content animate__animated animate__fadeIn animate__delay-1s">
                <p>Мы создаем уникальные вязаные изделия ручной работы с любовью и вниманием к деталям. Каждая вещь в нашем магазине - это результат кропотливой работы мастеров, которые вкладывают душу в свое дело.</p>
                <p>Наши коллекции сочетают в себе современные тренды и традиционные техники вязания, что позволяет создавать по-настоящему особенные вещи.</p>
            </div>
        </div>
    </section>

    <!-- Коллекции -->
    <section class="collection-section">
        <div class="container">
            <h2 class="section-title animate__animated animate__fadeIn">Наши коллекции</h2>
            <div class="collection-grid">
                <div class="collection-card">
                    <?= Html::img('@web/image/6.jpeg', [
                        'alt' => 'Коллекция Осень-Зима',
                        'class' => 'collection-img'
                    ]); ?>
                    <div class="collection-info">
                        <h3 class="collection-title">Головные уборы</h3>
                        <p class="collection-desc">Теплые и уютные вещи для холодного времени года</p>
                        <a href="/product/catalog?ProductSearch[category_id]=1" class="collection-btn">Смотреть</a>
                    </div>
                </div>
                <div class="collection-card">
                <?= Html::img('@web/image/123.jpeg', [
                        'alt' => 'Коллекция Весна-Летo',
                        'class' => 'collection-img'
                    ]); ?>
                    <div class="collection-info">
                        <h3 class="collection-title">Мяшкие игрушки</h3>
                        <p class="collection-desc">Для вас и ваших детей</p>
                        <a href="/product/catalog?ProductSearch[category_id]=4" class="collection-btn">Смотреть</a>
                    </div>
                </div>
                <div class="collection-card">
                <?= Html::img('@web/image/8.jpeg', [
                        'alt' => 'Коллекция Аксессуары',
                        'class' => 'collection-img'
                    ]); ?>
                    <div class="collection-info">
                        <h3 class="collection-title">Аксессуары</h3>
                        <p class="collection-desc"> Шарфы, варежки и другие аксессуары</p>
                        <a href="/product/catalog?ProductSearch[category_id]=3" class="collection-btn">Смотреть</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Преимущества -->
    <section class="features-section">
        <div class="container">
            <h2 class="section-title animate__animated animate__fadeIn">Почему выбирают нас</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <h3 class="feature-title">Ручная работа</h3>
                    <p class="feature-desc">Каждое изделие создается вручную с любовью и вниманием к деталям</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-spa"></i>
                    </div>
                    <h3 class="feature-title">Натуральные материалы</h3>
                    <p class="feature-desc">Используем только качественную пряжу из натуральных волокон</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3 class="feature-title">Уникальный дизайн</h3>
                    <p class="feature-desc">Авторские модели, которых нет в массмаркете</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <h3 class="feature-title">Быстрое создание и доставка</h3>
                    <p class="feature-desc">Авторские модели, изготовление которых не займет долгое время</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Рассылка -->
    <section class="newsletter-section">
    <div class="container">
        <h2 class="section-title1 animate__animated animate__fadeIn">Узнавайте первыми о новинках</h2>
        <p class="animate__animated animate__fadeIn animate__delay-1s" style="margin-bottom: 2rem; font-size: 1.2rem;">
            Подпишитесь на нашу рассылку и получайте информацию о новых коллекциях и специальных предложениях
        </p>
        <form id="newsletter-form" class="newsletter-form animate__animated animate__fadeIn animate__delay-2s">
            <input type="email" name="email" placeholder="Ваш email" class="newsletter-input" required>
            <button type="submit" class="newsletter-btn">Подписаться</button>
        </form>
        <div id="toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>
    </div>
</section>


</div>

<?php
$this->registerJs(<<<JS
    $(document).ready(function() {
        // Анимация при скролле
        function animateOnScroll() {
            $('.collection-card, .feature-card, .testimonial-card').each(function() {
                var cardTop = $(this).offset().top;
                var windowBottom = $(window).scrollTop() + $(window).height();
                if (windowBottom > cardTop + 100) {
                    $(this).addClass('animate__animated animate__fadeInUp');
                }
            });
        }

        animateOnScroll();
        $(window).scroll(animateOnScroll);

        // Пульсация кнопки
        setInterval(function() {
            $('.hero-btn').toggleClass('animate__pulse');
        }, 3000);

        // Подписка на рассылку
        $('#newsletter-form').on('submit', function(e) {
            e.preventDefault();
            var email = $(this).find('input[type="email"]').val();
            $.post('/subscribe/index', { email: email }, function(data) {
                showToast(data.message, data.success ? 'success' : 'error');
                if (data.success) {
                    $('#newsletter-form')[0].reset();
                }
            });
        });

        // Функция показа уведомлений
        function showToast(message, type = 'success') {
            const toast = $('<div></div>')
                .addClass('toast-message')
                .css({
                    padding: '1rem 1.5rem',
                    marginBottom: '1rem',
                    backgroundColor: type === 'success' ? '#4caf50' : '#f44336',
                    color: '#fff',
                    borderRadius: '8px',
                    boxShadow: '0 2px 6px rgba(0,0,0,0.2)',
                    opacity: 0,
                    transition: 'opacity 0.5s'
                })
                .text(message);

            $('#toast-container').append(toast);
            setTimeout(() => toast.css('opacity', 1), 10); // плавное появление
            setTimeout(() => {
                toast.css('opacity', 0);
                setTimeout(() => toast.remove(), 500);
            }, 3000); // автоудаление
        }
    });
JS);
?>
