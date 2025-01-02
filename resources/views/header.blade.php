<header>
    <div class="header-banner">
        <div class="header-content">
            <a href="{{ route('main') }}">
                <img src="https://i.pinimg.com/736x/a1/6b/a4/a16ba4b39ed3a448a699ce3d2be0c829.jpg" alt="Логотип Федерации" class="federation-logo">
            </a>
            <div class="header-titles">
                <h1>ФЕДЕРАЦИЯ БУРЯТСКОГО ШУУД-ТЕННИСА</h1>
                <h2>(БЫСТРОГО ТЕННИСА)</h2>
            </div>
            <div class="header-contact">
                info@shuud.ru
            </div>
        </div>
    </div>
    <nav class="main-navigation">
        <div class="nav-content">
            <ul class="nav-menu">
                <li><a href="{{ route('about') }}">О Федерации</a></li>
                <li><a href="{{ route('news') }}">Новости</a></li>
                <li><a href="#tournirs">Турниры</a></li>
                <li><a href="#schools">Обучение</a></li>
                <li><a href="#gallery">Медиа</a></li>
                <li><a href="#contacts">Контакты</a></li>
            </ul>
            <div class="login-wrapper">
                <div id="menuToggle">
                    <input type="checkbox" id="menuCheckbox" style="opacity: 0; width: 37px"/>
                    <span></span>
                    <span></span>
                    <span></span>

                    <div class="login-container">
                        <h2>Логин</h2>
                        <form action="{{ route('login') }}" method="POST" class="login-form">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Пароль</label>
                                <input type="password" id="password" name="password" required>
                            </div>

                            @if ($errors->any())
                                <div class="error-messages">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <button type="submit" class="login-button">Войти</button>
                        </form>

                        <div class="register-link">
                            <a href="{{ route('register') }}">Зарегистрироваться</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');
    :root {
        --primary-color: #003357;
        --secondary-color: #8B4513;
        --accent-color: #4A90E2;
        --text-color: #000000;
        --background-color: #F3EFEA;
        --max-width: 1200px;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Montserrat', sans-serif;
        background-color: var(--background-color);
        color: var(--text-color);
        overflow-x: hidden;
        width: 100%;
    }

    .header-banner {
        font-family: 'Montserrat', sans-serif;
        width: 100%;
        height: 110px;
        background: var(--background-color);
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
        max-width: var(--max-width);
        padding: 0 2rem;
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
        font-size: clamp(1.2rem, 2vw, 2rem);
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .header-titles h2 {
        font-size: 1rem;
        font-weight: normal;
        text-align: right;
        color: var(--primary-color);
    }

    .main-navigation {
        font-family: 'Montserrat', sans-serif;
        background-color: var(--primary-color);
        padding: 1.2rem 0;
        width: 100%;
    }

    .nav-content {
        max-width: var(--max-width);
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 2rem;
    }

    .main-navigation {
        background-color: var(--primary-color);
        padding: 1.2rem 0;
        position: relative;
    }

    .nav-content {
        max-width: 1800px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
    }

    .nav-menu {
        display: flex;
        justify-content: center;
        list-style: none;
        margin: 0;
        padding: 0;
        flex-grow: 1;
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

    .login-wrapper {
        position: relative;
        margin-left: auto;
    }

    #menuToggle {
        display: block;
        position: relative;
        z-index: 1000;
        -webkit-user-select: none;
        user-select: none;
        margin-right: 50px;
    }

    #menuToggle input {
        padding: 10px;
        font-size: 1rem;
        border: 1px solid #CCCCCC;
        border-radius: 5px;
        background-color: #FAFAFA;
        box-sizing: border-box;
        display: block;
        width: 170px;      /*ширина инпута для ввода данных*/
        height: 28px;
        position: absolute;
        top: -7px;
        right: -5px;
        cursor: pointer;
        opacity: 0;
        z-index: 2;
        -webkit-touch-callout: none;
    }

    #menuToggle span {
        display: block;
        width: 33px;
        height: 3px;
        margin-bottom: 5px;
        position: relative;
        background: #ffffff;
        border-radius: 3px;
        z-index: 1;
        transform-origin: 4px 0px;
        transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1.0),
        background 0.5s cubic-bezier(0.77,0.2,0.05,1.0),
        opacity 0.55s ease;
    }

    #menuToggle input:checked ~ span {
        opacity: 1;
        transform: rotate(45deg) translate(-2px, -1px);
        background: #232323;
    }

    #menuToggle input:checked ~ span:nth-last-child(3) {
        opacity: 0;
        transform: rotate(0deg) scale(0.2, 0.2);
    }

    #menuToggle input:checked ~ span:nth-last-child(2) {
        transform: rotate(-45deg) translate(0, -1px);
    }

    .login-container {
        position: absolute;
        width: 300px;
        right: -50px;
        top: 50px;
        padding: 2rem;
        background: white;
        border-radius: 8px;
        border: 1px solid #D4AF37;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transform: translate(100%, 0);
        transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1.0), opacity 0.5s ease;
        opacity: 0; /* Скрыто по умолчанию */
        pointer-events: none; /* Не кликабельно */
    }

    #menuToggle input:checked ~ .login-container {
        transform: none;
        pointer-events: auto;
        opacity: 1; /* Делает контейнер видимым */
    }

    .login-container input {
        opacity: 1 !important; /* Убедимся, что инпуты видимы */
        pointer-events: auto !important; /* Делаем их кликабельными */
        width: 100%;
    }

    .sticky {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 999;
        background-color: var(--primary-color);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .main-navigation.sticky + .content {
        padding-top: 60px;
    }

    /* Остальные стили для формы логина остаются без изменений */
    .login-form {
        position: relative;
        z-index: 1001;
    }

    .login-container h2 {
        margin: 0 0 1.5rem 0;
        color: var(--primary-color);
        font-size: 1.5rem;
        text-align: center;
    }

    .form-group {
        margin-bottom: 1rem;
        position: relative;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: #666;
        font-size: 0.9rem;
    }

    .form-group input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
        position: relative;
        z-index: 1002;
        background: white;
    }

    .form-group input:focus {
        outline: none;
        border-color: var(--accent-color);
    }

    .login-button {
        width: 100%;
        padding: 0.75rem;
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
        position: relative;
        z-index: 1002;
    }

    .login-button:hover {
        background: var(--accent-color);
    }

    .register-link {
        margin-top: 1rem;
        text-align: center;
        position: relative;
        z-index: 1001;
    }

    .register-link a {
        color: var(--accent-color);
        text-decoration: none;
        font-size: 0.9rem;
    }

    .register-link a:hover {
        text-decoration: underline;
    }
</style>

<script>
    const nav = document.querySelector('.main-navigation');
    window.addEventListener("scroll", function () {
        if (window.scrollY > 20) {
            nav.classList.add("sticky");
        } else {
            nav.classList.remove("sticky");
        }
    });
</script>
