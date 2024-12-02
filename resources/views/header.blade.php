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

</style>
