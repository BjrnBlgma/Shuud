@include('header')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>История федерации</title>
</head>


<main class="main-grid">

    <div class="main-text" style="font-size: 1.2rem; ">
        <h2 class="section-title sub" style="margin-top: 2rem">Задачи:</h2>
        <p>Организация и проведение турниров, соревнований, чемпионатов и фестивалей по шууд-теннису в Бурятии.</p>
        <br>
        <p>Популяризация шууд-тенниса среди детей, молодежи и взрослых через мастер-классы, открытые тренировки и
            спортивные мероприятия.</p>
        <br>
        <p>Разработка и внедрение программ по развитию детско-юношеского шууд-тенниса, создание специализированных школ
            и секций.</p>
        <br>
        <p>Содействие государственным и муниципальным органам в реализации программ развития физической культуры и
            спорта, связанных с шууд-теннисом.</p>
        <br>
        <p>Защита прав и интересов спортсменов, тренеров, судей и других специалистов в области шууд-тенниса.</p>
        <br>
        <p>Укрепление связей с национальными и международными спортивными организациями, участие в развитии
            международного сотрудничества в области шууд-тенниса.</p>
        <br>
        <p>Пропаганда здорового образа жизни и физической активности через популяризацию шууд-тенниса.</p>
    </div>
</main>

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
        width: 80%;
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem;
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
