<header>
    <div class="header-banner">
        <div class="header-content">
            <img src="https://i.pinimg.com/736x/a1/6b/a4/a16ba4b39ed3a448a699ce3d2be0c829.jpg" alt="Логотип Федерации" class="federation-logo">
            <div class="header-titles">
                <h1>ФЕДЕРАЦИЯ БУРЯТСКОГО ШУУД-ТЕННИСА</h1>
            </div>
            <div class="header-contact">
                <a href="">info@shuud.ru</a>
            </div>
        </div>
    </div>
    <nav class="main-navigation">
        <ul class="nav-menu">
            <li><a href="#about">О Федерации</a></li>
            <li><a href="#news">Новости</a></li>
            <li><a href="#tournirs">Турниры</a></li>
            <li><a href="#schools">Обучение</a></li>
            <li><a href="#gallery">Медиа</a></li>
            <li><a href="#contacts">Контакты</a></li>
        </ul>
    </nav>
</header>


<section class="news-section">
    <h2>Новости</h2>
    <div class="news-grid">
        @foreach($posts as $post)
        <article class="news-item">
            <img src="{{ $post->image }}" alt="Новость 1">
            <h3>{{ $post->title }}</h3>
            <p>{{ $post->content }}</p>
{{--            <p><?php print_r($post)?></p>--}}
            <a href="#" class="read-more">Читать далее</a>
        </article>
        @endforeach
    </div>
</section>


<footer>
    <div class="footer-content">
        <div class="footer-col">
            <img src="https://i.pinimg.com/736x/a1/6b/a4/a16ba4b39ed3a448a699ce3d2be0c829.jpg" alt="Логотип Федерации" class="footer-logo">
            <p>РОО "ФБШ-Т (БТ)"</p>
            <p>Президент - Очиров Дагба Доржибалович</p>
            <p>Вице-президент - Шотхоев Булат Гармаевич</p>
            <p>Исполнительный директор - Дамдинов Дашицырен Балданович</p>
        </div>
        <div class="footer-col">
            <h3>Контакты</h3>
            <p>Адрес: ул. Набережная, д. 17, офис 17, с.Верхняя Иволга, Иволгинский р-н, РБ</p>
            <p>Время работы: Пн-Пт 10:00-18:00</p>
        </div>
        <div class="footer-col">
            <h3>Социальные сети</h3>
            <div class="social-links">
                <a href="#" class="social-link">
                    <img src="https://i.pinimg.com/736x/bf/ab/dc/bfabdc55969052bf6003b1d46f6a5093.jpg" alt="VK">
                </a>
                <a href="#" class="social-link">
                    <img src="https://i.pinimg.com/736x/5e/39/c0/5e39c0a089b31c1c8cdd6b78ed2c9d58.jpg" alt="YouTube">
                </a>
                <a href="#" class="social-link">
                    <img src="https://i.pinimg.com/736x/57/13/84/5713846d630704ce892f9c93944ba451.jpg" alt="Telegram">
                </a>
            </div>
            <br>
            <br>
            <p>© 2024 РOO "ФЕДЕРАЦИЯ БУРЯТСКОГО ШУУД-ТЕННИСА (БЫСТРОГО ТЕННИСА)".</p>
            <p>Все права защищены.</p>
        </div>
    </div>
</footer>

<style>
    :root {
        --primary-color: #003357;
        --secondary-color: #8B4513;
        --accent-color: #4A90E2;
        --text-color: #00000;
        --background-color: #F3EFEA;
    }

    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        color: var(--text-color);
        background-color: var(--background-color);
    }

    /* Header Styles */
    .header-banner {
        width: 100%;
        height: 130px;
        background: #F3EFEA;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #23346e;
    }

    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        max-width: 1200px;
    }

    .federation-logo {
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }

    .header-titles {
        text-align: center;
    }

    .header-titles h1 {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .header-titles h2 {
        font-size: 1.2rem;
        font-weight: normal;
        color: var(--primary-color);
    }

    .header-contact a {
        color: #23346e;
        text-decoration: none;
        font-size: 1rem;
        opacity: 0.8;
        transition: opacity 0.5s;
    }

    .header-contact a:hover {
        opacity: 1;
    }

    .main-navigation {
        background-color: var(--primary-color);
        padding: 2rem 0;
    }

    .nav-menu {
        display: flex;
        justify-content: center;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .nav-menu li {
        margin: 0 4rem;
    }

    .nav-menu a {
        color: white;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-size: 1.2rem;
        transition: color 0.3s;
    }

    .nav-menu a:hover {
        color: var(--accent-color);
    }

    /* News Styles */
    .news-section {
        padding: 1rem 20rem;
    }

    .news-section h2 {
        text-align: center;
        margin-bottom: 2rem;
        font-size: 3rem;
    }

    .news-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 1rem;
    }

    .news-item {
        background-color: white;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        overflow: hidden;
    }

    .news-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .news-item h3 {
        font-size: 1.2rem;
        margin: 1rem;
    }

    .news-item p {
        font-size: 0.9rem;
        color: #666;
        margin: 0 1rem 1rem;
    }

    .news-item .read-more {
        display: block;
        background-color: #1c542d;
        color: white;
        text-align: center;
        text-decoration: darkgreen;
        padding: 0.5rem 1rem;
        transition: background-color 0.4s;
    }

    .news-item .read-more:hover {
        background-color: #158078;
    }

    /* Footer Styles */
    footer {
        background-color: var(--primary-color);
        color: white;
        padding: 2rem 1rem;
    }

    .footer-content {
        display: flex;
        justify-content: space-between;
        max-width: 1200px;
        margin: 0 auto;
    }

    .footer-col {
        flex: 1;
        margin: 0 1rem;
    }

    .footer-logo {
        width: 80px;
        height: 80px;
        border-radius: 50%;
    }

    .footer-col h3 {
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }

    .social-links {
        display: flex;
        justify-content: left;
    }

    .social-link {
        display: block;
        margin-left: 1.3rem;
        opacity: 0.8;
        transition: opacity 0.3s;
    }

    .social-link:hover {
        opacity: 1;
    }

    .social-link img {
        width: 30px;
        height: 30px;
        border-radius: 30%;
    }

    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            text-align: center;
        }

        .federation-logo {
            margin-bottom: 1rem;
        }

        .nav-menu {
            flex-direction: column;
            align-items: center;
        }

        .nav-menu li {
            margin: 0.8rem 0;
        }

        .news-grid {
            grid-template-columns: 1fr;
        }

        .footer-content {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .footer-col {
            margin: 1rem 0;
        }

        .social-links {
            justify-content: center;
        }
    }
</style>
