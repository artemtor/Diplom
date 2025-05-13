<?php
/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'О бабушке';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('https://fonts.googleapis.com/css2?family=Caveat:wght@400;700&family=Marck+Script&family=Montserrat:wght@300;400;600&display=swap');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js', ['position' => \yii\web\View::POS_HEAD]);
?>

<style>
    :root {
        --main-color: #7D6B5E;
        --secondary-color: #5a3e36;
        --accent-color: #d4a373;
        --light-bg: #fffaf0;
        --text-color: #5a3e36;
    }
    
    body {
        overflow-x: hidden;
        background-color: var(--light-bg);
        font-family: 'Montserrat', sans-serif;
        color: var(--text-color);
    }
    
    .knitting-text {
        font-family: 'Caveat', cursive;
        font-size: 1.5rem;
        line-height: 1.6;
        color: var(--text-color);
        margin-bottom: 1.5rem;
    }
    
    .knitting-container {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    
    .content-wrapper {
        display: flex;
        flex: 1;
    }
    
    .knitting-title {
        font-family: 'Marck Script', cursive;
        font-size: 3.5rem;
        color: var(--main-color);
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
        display: inline-block;
    }
    .knitting-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--main-color), var(--accent-color), var(--main-color));
        transform: scaleX(0);
        transform-origin: right;
        transition: transform 0.5s ease;
    }
    
    .knitting-title:hover::after {
        transform: scaleX(1);
        transform-origin: left;
    }
    
    .knitting-highlight {
        background: linear-gradient(transparent 60%, rgba(212, 163, 115, 0.3) 60%);
        padding: 0 0.2em;
        transition: all 0.3s ease;
    }
    
    .knitting-highlight:hover {
        background: linear-gradient(transparent 60%, var(--accent-color) 60%);
    }
    
    .knitting-border {
        border: 2px dashed var(--main-color);
        padding: 2rem;
        border-radius: 15px;
        background-color: var(--light-bg);
        margin-top: 3rem;
        position: relative;
        overflow: hidden;
    }
    
    .knitting-border::before {
        content: '';
        position: absolute;
        top: -10px;
        left: -10px;
        right: -10px;
        bottom: -10px;
        border: 2px solid var(--accent-color);
        border-radius: 20px;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.5s ease;
    }
    
    .knitting-border:hover::before {
        opacity: 0.5;
    }
    
    .knitting-button {
        font-family: 'Caveat', cursive;
        font-size: 1.3rem;
        background-color: var(--main-color);
        color: white;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 30px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }
    
    .knitting-button:hover {
        background-color: var(--secondary-color);
        color: white !important;
        transform: translateY(-3px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }
    
    /* Стили для фото */
    .photo-section {
        position: relative;
        width: 100%;
        overflow: hidden;
        flex-shrink: 0;
    }
    
    .photo-container {
        position: relative;
        width: 100%;
        padding-top: 75%; /* Соотношение 4:3 */
        overflow: hidden;
    }
    
    .grandma-photo {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center top;
        transition: transform 0.8s cubic-bezier(0.25, 0.45, 0.45, 0.95);
    }
    
    .photo-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }
    
    .content-section {
        flex: 1;
        padding: 2rem;
        max-width: 800px;
        margin: 0 auto;
    }
    
    /* Адаптивность */
    @media (min-width: 992px) {
        .knitting-container {
            flex-direction: row;
        }
        
        .photo-section {
            width: 40%;
            height: 100vh;
            position: sticky;
            top: 0;
        }
        
        .photo-container {
            padding-top: 0;
            height: 100%;
        }
        
        .content-section {
            width: 60%;
            padding: 3rem;
        }
    }
    
    @media (max-width: 768px) {
        .knitting-title {
            font-size: 2.5rem;
        }
        
        .knitting-text {
            font-size: 1.2rem;
        }
        
        .photo-container {
            padding-top: 100%; /* Квадратное соотношение для мобильных */
        }
    }
    
    @media (max-width: 576px) {
        .knitting-title {
            font-size: 2rem;
        }
        
        .photo-container {
            padding-top: 120%; /* Более высокое соотношение для портретных фото */
        }
    }
    
    /* Элементы вязания */
    .yarn-ball {
        position: absolute;
        width: 60px;
        height: 60px;
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="45" fill="none" stroke="%238b5e3c" stroke-width="3"/><circle cx="50" cy="50" r="35" fill="none" stroke="%238b5e3c" stroke-width="3"/><circle cx="50" cy="50" r="25" fill="none" stroke="%238b5e3c" stroke-width="3"/></svg>');
        background-size: contain;
        opacity: 0.3;
        z-index: 1;
        animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
        }
        50% {
            transform: translateY(-20px) rotate(5deg);
        }
    }
    
    /* Анимация появления текста */
    .text-reveal {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.6s ease;
    }
    
    .text-reveal.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Социальные иконки */
    .social-icon {
        font-size: 1.5rem;
        color: var(--main-color);
        margin: 0 10px;
        transition: all 0.3s ease;
    }
    
    .social-icon:hover {
        color: var(--accent-color);
        transform: scale(1.2);
    }
    
    /* Кастомный скроллбар */
    ::-webkit-scrollbar {
        width: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: var(--light-bg);
    }
    
    ::-webkit-scrollbar-thumb {
        background: var(--main-color);
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: var(--secondary-color);
    }
    
    /* Адаптивность */
    @media (max-width: 992px) {
        .knitting-container {
            flex-direction: column;
        }
        
        .photo-section {
            height: 50vh;
        }
        
        .content-section {
            padding: 2rem;
        }
    }
    
    @media (max-width: 768px) {
        .knitting-title {
            font-size: 2.5rem;
        }
        
        .knitting-text {
            font-size: 1.2rem;
        }
        
        .photo-section {
            height: 40vh;
        }
    }
    
    @media (max-width: 576px) {
        .knitting-title {
            font-size: 2rem;
        }
        
        .knitting-border {
            padding: 1.5rem;
        }
        
        .photo-section {
            height: 35vh;
        }
    }
</style>

<div class="site-about knitting-container">
    <!-- Элементы вязания (декоративные) -->
    <div class="yarn-ball" style="top: 10%; left: 5%; animation-delay: 0s;"></div>
    <div class="yarn-ball" style="top: 30%; right: 8%; animation-delay: 1s;"></div>
    <div class="yarn-ball" style="bottom: 20%; left: 7%; animation-delay: 2s;"></div>
    <div class="yarn-ball" style="bottom: 40%; right: 5%; animation-delay: 3s;"></div>
    
    <!-- Фото бабушки - теперь всегда будет полностью видно -->
    <div class="photo-section animate__animated animate__fadeInLeft">
        <div class="photo-container">
            <?= Html::img('@web/image/11.png', [
                'class' => 'grandma-photo',
                'alt' => 'Фото бабушки',
                'loading' => 'lazy'
            ]) ?>
            <div class="photo-overlay"></div>
        </div>
    </div>
    <!-- Текст и контент -->
    <div class="content-section d-flex flex-column justify-content-center p-lg-5 p-md-4 p-3 animate__animated animate__fadeInRight">
        <div class="knitting-border">
            <h1 class="knitting-title"><?= Html::encode($this->title) ?></h1>

            <!-- Текст о бабушке -->
            <div class="knitting-text">
                <p class="text-reveal">
                    Вязать я начала <span class="knitting-highlight">42 года назад</span>. В те времена красивые вещи в магазинах не продавали, а хотелось выглядеть красиво — дочку нарядить. Вязала штанишки, комбинезоны, кофты, шапочки, носочки. Потом, когда в магазинах появилось полно одежды, вязать я перестала. Был перерыв лет 40.
                </p>
                <p class="text-reveal">
                    А вот недавно, когда ехали с внуком на дачу на электричке, все дружно достали мобильные телефоны, а мой семнадцатилетний внук — <span class="knitting-highlight">спицы</span>. Сидел и вязал шарфик для своей девушки. Заразил. В то время на работе тоже началась перестройка, появилась новая начальство, которая мотало нервы, и я снова взяла спицы в руки. А оказалось — очень успокаивает.
                </p>
                <p class="text-reveal">
                    Внук научил вязать <span class="knitting-highlight">косметички</span>, и теперь не было проблем, что дарить коллегам на Новый год или 8 Марта. Каждому — свой любимый цвет. Сидишь дома, смотришь сериал и вяжешь. Руки работали сами. Связала шарфы, носки, шапки, косметички, сумочки пляжные, мешочки, сумочки для телефонов.
                </p>
                <p class="text-reveal">
                    Хобби у меня, конечно, много, и вязание — одно из них. Когда в каждую петельку вкладываешь свою душу, подарок становится очень приятным.
                </p>
            </div>

            <!-- Контактная информация -->
            <div class="text-center mt-4 text-reveal">
                <h3 style="font-family: 'Marck Script', cursive; color: var(--main-color);">Контакты</h3>
                <p style="font-size: 1.1rem;">
                    <i class="fas fa-envelope"></i> <strong>Email:</strong> babushka@babushka.ru<br>
                    <i class="fas fa-phone"></i> <strong>Телефон:</strong> +7 (123) 456-78-90
                </p>
            </div>

            <!-- Социальные сети -->
            <div class="text-center mt-4 text-reveal">
                <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-vk"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-pinterest"></i></a>
            </div>
            
            <!-- Кнопка перехода в магазин -->
            <div class="text-center mt-4 text-reveal">
                <a href="/product/catalog" class="btn knitting-button animate__animated animate__pulse animate__infinite animate__slower">
                    <i class="fas fa-shopping-basket mr-2"></i> В магазин
                </a>
            </div>
        </div>
    </div>
</div>

<?php
// Анимация появления элементов при скролле
$this->registerJs(<<<JS
    // Инициализация GSAP анимаций
    gsap.from(".photo-section", {
        duration: 1.5,
        x: -100,
        opacity: 0,
        ease: "power3.out"
    });
    
    gsap.from(".content-section", {
        duration: 1.5,
        x: 100,
        opacity: 0,
        ease: "power3.out",
        delay: 0.2
    });
    
    // Анимация появления текста при скролле
    const textReveals = document.querySelectorAll('.text-reveal');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, {
        threshold: 0.1
    });
    
    textReveals.forEach(reveal => {
        observer.observe(reveal);
    });
    
    // Анимация кнопки "В магазин"
    const shopBtn = document.querySelector('.knitting-button');
    if (shopBtn) {
        shopBtn.addEventListener('mouseenter', () => {
            shopBtn.classList.remove('animate__pulse');
        });
        
        shopBtn.addEventListener('mouseleave', () => {
            shopBtn.classList.add('animate__pulse');
        });
    }
JS);
?>

<!-- Подключение Font Awesome для иконок -->
<?php $this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'); ?>