<footer class="site-footer">

    <div class="site-footer__content">
        <div class="site-footer__col">
            <img src="https://i.pinimg.com/736x/a1/6b/a4/a16ba4b39ed3a448a699ce3d2be0c829.jpg" alt="Логотип Федерации" class="site-footer__logo">
            <p class="site-footer__text">РОО "ФБШ-Т (БТ)"</p>
            <p class="site-footer__text">Президент - Очиров Дагба Доржибалович</p>
            <p class="site-footer__text">Вице-президент - Шотхоев Булат Гармаевич</p>
            <p class="site-footer__text">Исполнительный директор - Дамдинов Дашицырен Балданович</p>
        </div>
        <div class="site-footer__col">
            <h3 class="site-footer__heading">Контакты</h3>
            <p class="site-footer__text">Адрес: ул. Набережная, д. 17, офис 17, с.Верхняя Иволга, Иволгинский р-н, РБ</p>
            <p class="site-footer__text">Время работы: Пн-Пт 10:00-18:00</p>
        </div>
        <div class="site-footer__col">
            <h3 class="site-footer__heading">Социальные сети</h3>
            <div class="site-footer__social-links">
                <a href="#" class="site-footer__social-link">
                    <img src="https://i.pinimg.com/736x/bf/ab/dc/bfabdc55969052bf6003b1d46f6a5093.jpg" alt="VK" class="site-footer__social-icon">
                </a>
                <a href="#" class="site-footer__social-link">
                    <img src="https://i.pinimg.com/736x/5e/39/c0/5e39c0a089b31c1c8cdd6b78ed2c9d58.jpg" alt="YouTube" class="site-footer__social-icon">
                </a>
                <a href="#" class="site-footer__social-link">
                    <img src="https://i.pinimg.com/736x/57/13/84/5713846d630704ce892f9c93944ba451.jpg" alt="Telegram" class="site-footer__social-icon">
                </a>
            </div>
            <br>
            <br>
            <p class="site-footer__copyright">© 2024 РOO "ФЕДЕРАЦИЯ БУРЯТСКОГО ШУУД-ТЕННИСА (БЫСТРОГО ТЕННИСА)".</p>
            <p class="site-footer__copyright">Все права защищены.</p>
        </div>
    </div>
</footer>

<script src="https://kit.fontawesome.com/8fe048c345.js" crossorigin="anonymous"></script>
<style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');

    :root {
        --primary-color: #003357;
        --secondary-color: #8B4513;
        --accent-color: #4A90E2;
        --text-color: #00000;
        --background-color: #F3EFEA;
    }

    body {
        font-family: 'Montserrat', sans-serif;
        margin: 0;
        padding: 0;
        color: var(--text-color);
        background-color: var(--background-color);
    }


    .site-footer {
        font-family: 'Montserrat', sans-serif;  /* Применяем шрифт только к футеру */
        background-color: var(--primary-color, #003357);
        color: white;
        padding: 2rem 1rem;
        margin: 0;
        width: 100%;
    }

    .site-footer * {
        box-sizing: border-box;
    }

    .site-footer__content {
        display: flex;
        justify-content: space-between;
        max-width: 1200px;
        margin: 0 auto;
        gap: 2rem;
    }

    .site-footer__col {
        flex: 1;
        min-width: 0;
    }

    .site-footer__logo {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin-bottom: 1rem;
    }

    .site-footer__heading {
        font-size: 1.2rem;
        margin-bottom: 1rem;
        color: white;
    }

    .site-footer__text {
        color: white;
        margin-bottom: 0.5rem;
        line-height: 1.5;
    }

    .site-footer__social-links {
        display: flex;
        gap: 1.3rem;
    }

    .site-footer__social-link {
        display: block;
        opacity: 0.8;
        transition: opacity 0.3s;
    }

    .site-footer__social-link:hover {
        opacity: 1;
    }

    .site-footer__social-icon {
        width: 30px;
        height: 30px;
        border-radius: 30%;
    }

    .site-footer__copyright {
        color: white;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    /* Адаптивность для мобильных устройств */
    @media (max-width: 768px) {
        .site-footer__content {
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 2rem;
        }

        .site-footer__col {
            width: 100%;
            margin: 0;
        }

        .site-footer__social-links {
            justify-content: center;
        }

        .site-footer__logo {
            margin: 0 auto 1rem;
        }
    }

    /* Дополнительная адаптивность для очень маленьких экранов */
    @media (max-width: 480px) {
        .site-footer {
            padding: 1.5rem 0.5rem;
        }

        .site-footer__heading {
            font-size: 1.1rem;
        }

        .site-footer__text {
            font-size: 0.9rem;
        }
    }
</style>
