<header role="banner">
    <h1>Admin Panel</h1>
    <ul class="utilities">
        <br>
        <li class="logout warn"><a href="">Выйти</a></li>
    </ul>
</header>

<nav role='navigation' id="site-content">
    <div class="avatar">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCNOdyoIXDDBztO_GC8MFLmG_p6lZ2lTDh1ZnxSDawl1TZY_Zw" alt="">
        <div class="avatarName">Сайн,<br>{{ $user->name ?? 'тамиршан'}}!</div>
    </div>
    <ul class="main">
        <li class="dashboard"><a href="">Dashboard</a></li>
        <li class="cup"><a href="{{ route('add-tournament') }}">Создать соревнование</a></li>
        <li class="postList"><a href="{{ route('admin') }}">Список новостей</a></li>
{{--        <li class="competitionsList"><a href="{{ route('tournaments-list') }}">Список турниров</a></li>--}}
{{--        <li class="mediaList"><a href="{{ route('admin') }}">Список медиапостов</a></li>--}}
        <li class="write dropdown">
            <a href="#">Создать</a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('create-post', ['section' => 1]) }}">Новости</a></li>
                <li><a href="{{ route('create-post', ['section' => 2]) }}">Положение турнира</a></li>
                <li><a href="{{ route('create-post', ['section' => 3]) }}">Медиа</a></li>
            </ul>
        </li>
        <li class="comments"><a href="">Реклама</a></li>
        <li class="users"><a href="">Управление пользователями</a></li>
        <li class="edit"><a href="">Редактировать сайт</a></li>
    </ul>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const dropdown = document.querySelector('.write');
        dropdown.addEventListener('mouseover', () => {
            const menu = dropdown.querySelector('.dropdown-menu');
            menu.style.display = 'block';
        });
        dropdown.addEventListener('mouseout', () => {
            const menu = dropdown.querySelector('.dropdown-menu');
            menu.style.display = 'none';
        });
    });
</script>

<style>
    /* Стили для раскрывающегося меню */
    .dropdown {
        position: relative;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 0;
        left: 50%;
        background: #2a3542;
        list-style: none;
        padding: 0;
        margin: 0;
        border: 1px solid rgba(255, 255, 255, 0.1);
        z-index: 1000;
    }

    .dropdown-menu li a {
        padding: 0.7em;
        display: block;
        color: #ddd;
        text-decoration: none;
        white-space: nowrap;
    }

    .dropdown-menu li a:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }
    #site-content {
        filter: none;
        transition: filter 0.3s ease;
    }

    .dropdown-menu.active ~ #site-content {
        filter: blur(100%); /* Размытие фона */
    }
    .avatar {
        margin: 50px 1em;
        position: relative;
        display: table;
    }
    .avatar img {
        display: table-cell;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #fff;
        border: 2px solid #fff;
        overflow: hidden;
    }
    .avatarName {
        display: table-cell;
        vertical-align: middle;
        padding-left: 1em;
        color: #fff;
        line-height: 1.5;
    }
</style>

<style>
    @charset "UTF-8";
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic);
    @import url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css);
    html {
        box-sizing: border-box;
    }

    *,
    *:before,
    *:after {
        box-sizing: inherit;
    }

    body {
        background: #f1f2f7;
        color: darkslategray;
        font-family: "Open Sans", Arial, sans-serif;
    }

    body.login {
        background-color: white;
        max-width: 500px;
        margin: 10vh auto;
        padding: 1em;
        height: auto;
    }

    .warn {
        color: red;
    }

    /* current nav item */
    .current, .dashboard .dashboard a,
    .write .write a,
    .edit .edit a,
    .comments .comments a,
    .users .users a {
        background-color: rgba(255, 255, 255, 0.1);
    }

    /* typography */
    a {
        text-decoration: none;
        color: inherit;
    }

    h2,
    h3,
    h4 {
        font-weight: 300;
        margin: 0;
    }

    h2 {
        color: #ff1a1a;
    }

    b {
        color: lightsalmon;
    }

    .hint {
        color: lightslategray;
    }

    /* lists */
    ul,
    li {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }



    /* header */
    header[role="banner"] {
        background: white;
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.15);
    }
    header[role="banner"] h1 {
        margin: 0;
        font-weight: 300;
        padding: 1rem;
    }
    header[role="banner"] h1:before {
        content: "\f248";
        font-family: FontAwesome;
        padding-right: 0.6em;
        color: red;
    }
    header[role="banner"] .utilities {
        width: 100%;
        background: slategray;
        color: #ddd;
    }
    header[role="banner"] .utilities li {
        border-bottom: solid 1px rgba(255, 255, 255, 0.2);
    }
    header[role="banner"] .utilities li a {
        padding: 0.7em;
        display: block;
    }

    /* header */
    .utilities a:before {
        content: "\f248";
        font-family: FontAwesome;
        padding-right: 0.6em;
    }

    .logout a:before {
        content: "";
    }

    .users a:before {
        content: "";
    }

    nav[role="navigation"] {
        background: #2a3542;
        color: #ddd;
        /* icons */
    }
    nav[role="navigation"] li {
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }
    nav[role="navigation"] li a {
        color: #ddd;
        text-decoration: none;
        display: block;
        padding: 0.7em;
    }
    nav[role="navigation"] li a:hover {
        background-color: rgba(255, 255, 255, 0.05);
    }
    nav[role="navigation"] li a:before {
        content: "\f248";
        font-family: FontAwesome;
        padding-right: 0.6em;
    }

    nav[role="navigation"] .dashboard a:before {
        content: ""; /*dashboard*/
    }
    nav[role="navigation"] .write a:before {
        content: ""; /*плюсик для создать */
    }
    nav[role="navigation"] .edit a:before {
        content: "";  /*карандашик для редактировать*/
    }
    nav[role="navigation"] .comments a:before {
        content: ""; /*сообщение для рекламы*/
    }
    nav[role="navigation"] .users a:before {
        content: ""; /*человечек ждя упр.юзерами*/
    }
    nav[role="navigation"] .cup a:before {
        content: "\1F3C6"; /* кубок */
    }
    nav[role="navigation"] .competitionsList a:before {
        content: "\1f4c4"; /* список положений турниров */
    }
    nav[role="navigation"] .mediaList a:before {
        content: "\1F4F7"; /* список всех медиа*/
    }
    nav[role="navigation"] .newsList a:before {
        content: "\1f5de"; /* список всех новостей*/
    }

    @media screen and (min-width: 600px) {
        html,
        body {
            height: 100%;
        }

        header[role="banner"] {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 99;
            height: 75px;
        }
        header[role="banner"] .utilities {
            position: absolute;
            top: 0;
            right: 0;
            background: transparent;
            color: darkslategray;
            width: auto;
        }
        header[role="banner"] .utilities li {
            display: inline-block;
        }
        header[role="banner"] .utilities li a {
            padding: 0.5em 1em;
        }

        nav[role="navigation"] {
            position: fixed;
            width: 200px;
            top: 75px;
            bottom: 0px;
            left: 0px;
        }

        main[role="main"] {
            margin: 75px 0 40px 200px;
        }
        main[role="main"]:after {
            content: "";
            display: table;
            clear: both;
        }

        .panel {
            margin: 2% 0 0 2%;
            float: left;
            width: 96%;
        }
        .panel:after {
            content: "";
            display: table;
            clear: both;
        }

        .box, .onethird, .twothirds {
            padding: 1rem;
        }

        .onethird {
            width: 33.333%;
            float: left;
        }

        .twothirds {
            width: 66%;
            float: left;
        }

        footer[role="contentinfo"] {
            clear: both;
            margin-left: 200px;
        }
    }
    @media screen and (min-width: 900px) {
        footer[role="contentinfo"] {
            position: fixed;
            width: 100%;
            bottom: 0;
            left: 0px;
            margin: 0;
        }

        .panel {
            width: 47%;
            clear: none;
        }
        .panel.important {
            width: 96%;
        }
        .panel.secondary {
            width: 23%;
        }
    }

    @media screen and (max-width: 600px) {
        nav[role="navigation"] {
            position: static;
            width: 100%;
        }
        main[role="main"] {
            margin: 0;
        }
    }

</style>
