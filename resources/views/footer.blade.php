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

    .footer-col p {
        color: white;
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
