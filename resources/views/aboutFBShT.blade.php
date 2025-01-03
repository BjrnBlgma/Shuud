@include('header')

<html>
<head>
    <title>О федерации</title>
</head>
<body>

<main class="main-grid">
    <div class="headAbout" style="display: flex; align-items: center; justify-content: space-between; width: 100%">
        <div>
            <img src="https://i.pinimg.com/736x/a1/6b/a4/a16ba4b39ed3a448a699ce3d2be0c829.jpg" alt="Логотип Федерации"
                 class="logo" style="width: 300px; height: 300px; border-radius: 50%;">
        </div>
        <div>
            <h1 class="page-title">О нас</h1>
            <br>
            <p class="subtitle" style="width: 800px">РЕГИОНАЛЬНАЯ ОБЩЕСТВЕННАЯ ОРГАНИЗАЦИЯ</p>
            <p class="subtitle" style="width: 800px">"ФЕДЕРАЦИЯ БУРЯТСКОГО ШУУД-ТЕННИСА <br> (БЫСТРОГО ТЕННИСА)"</p>
        </div>
    </div>



    <img class="main-image" src="https://static.mk.ru/upload/entities/2018/06/05/articlesImages/image/61/ab/11/d9/58239133312c23f13d71be2f1600652e.jpg" alt="">

    <div class="main-text" style="font-size: 1.2rem; ">
        <h2 class="section-title">Наши цели:</h2>
        <p>Развитие физической и духовной культуры и спорта, создание условий для практического осуществления программ сохранения и возрождения традиций бурятского народа.</p>
        <br>
        <p>Развитие и популяризация бурятского шууд-тенниса (быстрого тенниса) как национального и массового вида спорта на территории Республики Бурятии.</p>
        <br>
        <p>Подготовка спортсменов для участия в республиканских, российских и международных соревнованиях.</p>

        <h2 class="section-title sub" style="margin-top: 3rem">Задачи:</h2>
        <p>Организация и проведение турниров, соревнований, чемпионатов и фестивалей по шууд-теннису в Бурятии.</p>
        <br>
        <p>Популяризация шууд-тенниса среди детей, молодежи и взрослых через мастер-классы, открытые тренировки и спортивные мероприятия.</p>
        <br>
        <p>Разработка и внедрение программ по развитию детско-юношеского шууд-тенниса, создание специализированных школ и секций.</p>
        <br>
        <p>Содействие государственным и муниципальным органам в реализации программ развития физической культуры и спорта, связанных с шууд-теннисом.</p>
        <br>
        <p>Защита прав и интересов спортсменов, тренеров, судей и других специалистов в области шууд-тенниса.</p>
        <br>
        <p>Укрепление связей с национальными и международными спортивными организациями, участие в развитии международного сотрудничества в области шууд-тенниса.</p>
        <br>
        <p>Пропаганда здорового образа жизни и физической активности через популяризацию шууд-тенниса.</p>
    </div>

</main>

</body>
</html>

@include('footer')


<style>
    * {box-sizing: border-box;}

    body {
        margin: 0;
        font-family: 'Montserrat', sans-serif;
        background-color: white;
        color: black;
    }

    .main-grid {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr minmax(0, 2fr);
        gap: 2rem;
        padding: 2rem;
        align-items: center; /* Выравнивает элементы по центру по вертикали */
    }

    .headAbout {
        grid-column: 1 / -1;
        display: flex;
        align-items: center;
        gap: 2rem;
        margin: 2rem 0;
        font-size: 1.75rem;
    }

    .main-image {
        width: 100%;
        height: auto;
        object-fit: cover;
        box-shadow: 5px 5px 25px rgba(0, 0, 0, 0.2);
        display: block;
        margin: 0 auto; /* Центрирует изображение по горизонтали */
    }
    .main-grid > div:first-child {
        display: flex;
        align-items: center; /* Центрирует изображение по вертикали */
        justify-content: center; /* Центрирует изображение по горизонтали */
    }

    .main-text {
        padding: 1rem;

    }

    .section-title {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .section-title::after {
        content: "";
        display: block;
        width: 100px;
        height: 3px;
        margin-top: 1em;
        background: #fda039;
    }

    @media (max-width: 768px) {
        .main-grid {
            grid-template-columns: 1fr;
        }

        .headAbout {
            flex-direction: column;
            text-align: center;
        }

        .section-title::after {
            margin: 1em auto 0;
        }
    }

</style>
