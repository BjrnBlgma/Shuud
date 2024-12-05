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
        <div class="avatarName">Сайн, <br>{{ $user->name ?? ''}}!</div>
    </div>
    <ul class="main">
        <li class="dashboard"><a href="">Dashboard</a></li>
        <li class="postList"><a href="{{ route('admin') }}">Список постов</a></li>
        <li class="edit"><a href="">Редактировать сайт</a></li>
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
    </ul>
</nav>

<main role="main" id="site-content">
    <section class="panel important">
        <h2>Создать {{ $postType->name ?? '' }}</h2>
        <form action="" method="post">
            <div class="twothirds">
                Заголовок:<br/>
                <input type="text" name="title" size="40"/><br/><br/>
                Текст:<br/>
                <textarea name="newstext" rows="15" cols="67"></textarea><br/>
            </div>
            <div class="twothirds">
                <input type="hidden" id="currentSection" value="{{ $section ?? '' }}">
            </div>

            <div class="twothirds">
                <label for="image">Добавить изображение:</label>
                <input type="file" name="image" id="image" value="{{ old('image') }}"  required>
                <input type="submit" name="submit" value="Сохранить" />
            </div>
        </form>
    </section>
</main>


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
        content: "";
    }
    nav[role="navigation"] .write a:before {
        content: "";
    }
    nav[role="navigation"] .edit a:before {
        content: "";
    }
    nav[role="navigation"] .comments a:before {
        content: "";
    }
    nav[role="navigation"] .users a:before {
        content: "";
    }

    /* current nav item */
    .current, .dashboard .dashboard a,
    .write .write a,
    .edit .edit a,
    .comments .comments a,
    .users .users a {
        background-color: rgba(255, 255, 255, 0.1);
    }

    footer[role="contentinfo"] {
        background: slategray;
        color: #ddd;
        font-size: 0.8em;
        text-align: center;
        padding: 0.2em;
    }

    /* panels */
    .panel {
        background-color: white;
        color: darkslategray;
        -webkit-border-radius: 0.3rem;
        -moz-border-radius: 0.3rem;
        -ms-border-radius: 0.3rem;
        border-radius: 0.3rem;
        margin: 1%;
    }
    .panel > h2, .panel > ul {
        margin: 1rem;
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

    main li {
        position: relative;
        padding-left: 1.2em;
        margin: 0.5em 0;
    }
    main li:before {
        content: "";
        position: absolute;
        width: 0;
        height: 0;
        left: 0;
        top: 0.3em;
        border-left: solid 10px #dde;
        border-top: solid 5px transparent;
        border-bottom: solid 5px transparent;
    }

    /* forms */
    form input,
    form textarea,
    form select {
        width: 100%;
        display: block;
        border: solid 1px #dde;
        padding: 0.5em;
    }
    form input:after,
    form textarea:after,
    form select:after {
        content: "";
        display: table;
        clear: both;
    }
    form input[type="checkbox"],
    form input[type="radio"] {
        display: inline;
        width: auto;
    }
    form label,
    form legend {
        display: block;
        margin: 1em 0 0.5em;
    }
    form input[type="submit"] {
        background: #ff1a1a;
        border: none;
        border-bottom: solid 4px #e60000;
        padding: 0.7em 3em;
        margin: 1em 0;
        color: white;
        text-shadow: 0 -1px 0 #e60000;
        font-size: 1.1em;
        font-weight: bold;
        display: inline-block;
        width: auto;
        -webkit-border-radius: 0.5em;
        -moz-border-radius: 0.5em;
        -ms-border-radius: 0.5em;
        border-radius: 0.5em;
    }
    form input[type="submit"]:hover {
        background: turquoise;
        border: none;
        border-bottom: solid 4px #21ccbb;
        padding: 0.7em 3em;
        margin: 1em 0;
        color: white;
        text-shadow: 0 -1px 0 #21ccbb;
        font-size: 1.1em;
        font-weight: bold;
        display: inline-block;
        width: auto;
        -webkit-border-radius: 0.5em;
        -moz-border-radius: 0.5em;
        -ms-border-radius: 0.5em;
        border-radius: 0.5em;
    }

    /* feedback */
    .error {
        background-color: #ffe9e0;
        border-color: #ffc4ad;
    }

    label.error {
        padding: 0.2em 0.5em;
    }

    .feedback {
        background: #fcfae6;
        color: #857a11;
        margin: 1em;
        padding: 0.5em 0.5em 0.5em 2em;
        border: solid 1px khaki;
    }
    .feedback:before {
        content: "";
        font-family: fontawesome;
        color: #e4d232;
        margin-left: -1.5em;
        margin-right: 0.5em;
    }
    .feedback li:before {
        border-left-color: #f6f0b9;
    }
    .feedback.error {
        background: #ffe9e0;
        color: #942a00;
        margin: 1em;
        padding: 0.5em 0.5em 0.5em 2em;
        border: solid 1px lightsalmon;
    }
    .feedback.error:before {
        content: "";
        font-family: fontawesome;
        color: #ff5714;
        margin-left: -1.5em;
        margin-right: 0.5em;
    }
    .feedback.error li:before {
        border-left-color: #ffc4ad;
    }
    .feedback.success {
        background: #98eee6;
        color: #08322e;
        margin: 1em;
        padding: 0.5em 0.5em 0.5em 2em;
        border: solid 1px turquoise;
    }
    .feedback.success:before {
        content: "";
        font-family: fontawesome;
        color: #1aa093;
        margin-left: -1.5em;
        margin-right: 0.5em;
    }
    .feedback.success li:before {
        border-left-color: #6ce7db;
    }

    /* tables */
    table {
        border-collapse: collapse;
        width: 96%;
        margin: 2%;
    }

    th {
        text-align: left;
        font-weight: 400;
        font-size: 13px;
        text-transform: uppercase;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        padding: 0 10px;
        padding-bottom: 14px;
    }

    tr:not(:first-child):hover {
        background: rgba(0, 0, 0, 0.1);
    }

    td {
        line-height: 40px;
        font-weight: 300;
        padding: 0 10px;
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


    .form {
        background: #fff;
        border: 1px solid #dedede;
    }
    .formHeader {
        padding: 1em;
        background: #fff;
        border-bottom: 1px solid #dedede;
        display: flex;
        justify-content: space-between;
    }
    .formBody {
        width: 100%;
        padding: 20px 20px 10px 20px;
    }

    /* LIST FORM */
    .btnAdd, .btnSave, .btnEdit, .btnRemove {
        padding: 0.5em;
        margin: 0 2px;
    }
    .btnSave {
        border: none;
        outline: none;
        cursor: pointer;
        font-size: 0.95em;
    }
    .btnSwitch {
        font-size: 10px;
    }
    .btnSwitch.all {
        position: absolute;
        bottom: calc(100% + 3.7em);
        left: calc(50% - 4em);
    }
    .scrollX {
        width: 100%;
        overflow-x: scroll;
    }
    .table {
        width: 100%;
        min-width: 768px;
    }
    .table .row {
        width: 100%;
    }
    .table .row .cell {
        display: table-cell;
        padding: 10px;
        vertical-align: middle;
    }
    .table>ul>li {
        border-bottom: 1px solid #dedede;
    }
    .table .cell-50 {
        -max-width: 50px;
        min-width: 50px;
    }
    .table .cell-100 {
        -max-width: 100px;
        min-width: 100px;
    }
    .table .cell-150 {
        -max-width: 150px;
        min-width: 150px;
    }
    .table .cell-200 {
        -max-width: 200px;
        min-width: 200px;
    }
    .table .cell-100p {
        width: 100%;
    }
</style>
