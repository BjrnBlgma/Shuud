@include('admin.headerAdmin')

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    @if(!empty($tournament))
        <title>Инвормация о турнире "{{ $tournament->name }}"</title>
    @endif
</head>

<main role="main" id="site-content">
    <section class="panel important">
        <h2>Информация о турнире</h2>
        <div class="form-group">
            <label for="name">Название турнира:</label>
            <p> {{ $tournament->name }} </p>
        </div>

        <!-- Описание -->
        <div class="form-group">
            <label for="description">Описание:</label>
            <p>
                {{ $tournament->description }}
            </p>
        </div>


        <!-- Местоположение -->
        <div class="form-row">
            <div class="form-row2">
                <div class="form-group half-width2">
                    <label for="location">Кол-во участников:</label>
                    <p>{{ count($tournament->tournamentParticipants) ?? '0' }}</p>
                </div>
                <div class="form-group half-width2">
                    @if(count($tournament->tournamentParticipants) > 0)
                        <a href="{{ route('list-of-participants', ['tournament_id' => $tournament->id]) }}">
                            <button id="edit-toggle-btn" class="btnAdd btn-spacing" style="background-color:blue; color: white; margin-top: 10px;">
                                Список всех участников
                            </button>
                        </a>

                    <br>

                        <a href="{{ route('tournament-applications', ["tournament_id" => $tournament->id] )}}" class="btnAdd">
                            <button class="btnAdd fa fa-pencil bg-1 text-fff"
                                    style="background-color:#573b1d; color: white "> Посмотреть заявки
                            </button>
                        </a>


                    @else
                    <a href="{{ route('add-athlete', ["tournament_id" => $tournament->id]) }}">
                        <button id="edit-toggle-btn" class="btnAdd fa fa-plus bg-1 text-fff"
                                style="background-color:yellowgreen; color: white; margin-top: 30px "> Добавить участника
                        </button>
                    </a>
                    @endif
                </div>
            </div>
            <div class="form-group half-width">
                <label for="location">Местоположение:</label>
                <p> {{ $tournament->location }} </p>
            </div>
        </div>

        <!-- Статус -->
        <div class="form-group" >
            <label class="status">Статус:</label>
            <p class="status-{{ $tournament->status }}">
                {{ $tournament->status_label }}
            </p>
        </div>

        <!-- Статичные поля -->
        <div class="form-row">
            <div class="form-group half-width">
                <label for="start_date">Дата начала турнира:</label>
                <p>{{ $tournament->start_date }}</p>
            </div>
            <div class="form-group half-width">
                <label for="end_date">Дата завершения турнира:</label>
                <p>{{ $tournament->end_date }}</p>
            </div>
        </div>

        <div class="form-group" style="color: brown">
            <label style="color: brown">Создатель:</label>
            <p>{{ $tournament->user->surname ?? '' }} {{ $tournament->user->name ?? '' }}</p>
        </div>
    </section>
    <section class="panel important" style="margin-top: -20px">
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

                @if(empty($tournament->registration_token))
                    <form method="POST" action="{{ route('generate-registration-link', ['tournament_id' => $tournament->id]) }}">
                        @csrf
                        <button type="submit" class="btnEd" style="background-color: orange; color: white;">Создать ссылку</button>
                    </form>
                @else
                    <div style="display: flex; align-items: center; justify-content: space-between; width: 100%">
                        <button onclick="copyToClipboard({{ $tournament->id }})" class="btnAdd" style="background-color: green; color: white; padding: 0.4rem ">Скопировать ссылку</button>
                        <input type="text" id="registration-link-{{ $tournament->id }}" value="{{ route('register-guest', ['tournament_id' => $tournament->id, 'registration_token' => $tournament->registration_token]) }}" readonly style=" width: 83%;">
                    </div>
                @endif
    </section>
    <section class="panel important" style="margin-top: -20px">
        <a href="{{ route('edit-tournament', $tournament->id) }}" class="edit-btn">
            <button class="btnEdit fa fa-pencil bg-1 text-fff" style="background-color:#573b1d; color: white "> Редактировать информацию о турнире</button>
        </a>
    </section>
</main>



<script>
    function copyToClipboard(tournamentId) {
        const linkInput = document.getElementById('registration-link-' + tournamentId);
        linkInput.select();
        linkInput.setSelectionRange(0, 99999); // Для мобильных устройств
        document.execCommand('copy');

        // Используем SweetAlert2 для уведомления
        Swal.fire({
            icon: 'success',
            title: 'Ссылка скопирована!',
            text: 'Теперь ссылка находится в буфере обмена.',
            timer: 1200,  // Скрытие через 2 секунды
            showConfirmButton: false
        });
    }
</script>

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
        margin-left: 15%;
    }

    h2 {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 1rem;
        color: #ff1a1a;
    }

    .panel {
        background-color: #fff;
        margin: 2rem auto;
        padding: 1.2rem;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 1000px;
    }

    .form-group {
        margin-bottom: 1.4rem;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 0.4rem;
        color: #555;
    }

    p {
        padding: 0.4rem;
        background: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-family: "Open Sans", Arial, sans-serif;
    }

    input[type="text"],
    input[type="date"],
    select {
        width: 100%;
        padding: 0.4rem;
        font-size: 1rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        background: #f9f9f9;
        transition: border-color 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="date"]:focus,
    select:focus {
        border-color: #007bff;
        outline: none;
    }

    .btn-submit {
        display: block;
        width: 100%;
        padding: 0.8rem;
        font-size: 1rem;
        color: #fff;
        background: #007bff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-align: center;
        transition: background 0.3s ease;
    }

    .btn-submit:hover {
        background: #0056b3;
    }
    .status-active { color: green; }
    .status-registration_of_athletes { color: blue; }
    .status-completed { color: gray; }
    .status-upcoming { color: indigo; }
    .status-cancelled{ color: red; }

    .form-row {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
    }
    .form-row2{
        display: flex;
        justify-content: space-between;
        gap: 1rem;
    }
    .half-width2{
        flex: 1;
    }
    .form-row2 .half-width2 input,
    .form-row2 .half-width2 select {
        width: 100%;
    }

    .half-width {
        flex: 1;
    }

    .form-row .half-width input,
    .form-row .half-width select {
        width: 100%;
    }

    .edit-btn {
        display: flex;
        justify-content: right; /* Выравниваем кнопку справа */
    }

    .btnEdit {
        padding: 1rem 2rem; /* Увеличиваем размеры кнопки */
        font-size: 1.2rem; /* Крупный текст */
        background-color: #573b1d;
        color: white;
        border: none;
        border-radius: 8px; /* Округленные края */
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btnEdit:hover {
        background-color: #6e4a24; /* Немного светлее при наведении */
        transform: scale(1.05); /* Легкое увеличение */
    }

    .btn-spacing {
        margin-bottom: 10px;
    }
</style>
