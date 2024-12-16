@include('admin.headerAdmin')

<main role="main" id="site-content">
    <section class="panel important">
        <h2>Редактировать турнир</h2>
        <form action="{{ route('edit-tournament', $tournament->id) }}" method="POST">
            @csrf

            <!-- Название турнира -->
            <div class="form-group">
                <label for="name">Название турнира:</label>
                <input type="text" name="name" id="name" value="{{ $tournament->name }}" required>
            </div>

            <!-- Описание -->
            <div class="form-group">
                <label for="description">Описание:</label>
                <textarea id="description-editor" name="description" rows="5" style="width: 100%; background: #f9f9f9; border: 1px solid #ddd; border-radius: 5px; padding: 10px">{{ $tournament->description }}</textarea>
            </div>


            <!-- Местоположение -->
            <div class="form-group">
                <label for="location">Местоположение:</label>
                <input type="text" name="location" id="location" value="{{ $tournament->location }}">
            </div>

            <!-- Статус -->
            <div class="form-group">
                <label for="status">Статус:</label>
                <select id="status" name="status">
                    @foreach (App\Enums\TournamentStatus::cases() as $status)
                        <option value="{{ $status->value }}" {{ $tournament->status === $status->value ? 'selected' : '' }}>
                            {{ match ($status) {
                App\Enums\TournamentStatus::REGISTRATION => 'Регистрация спортсменов',
                App\Enums\TournamentStatus::ACTIVE => 'Активен',
                App\Enums\TournamentStatus::COMPLETED => 'Завершён',
                App\Enums\TournamentStatus::CANCELLED => 'Отменён',
                App\Enums\TournamentStatus::UPCOMING => 'Запланирован',
            } }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-row">
                <div class="form-group half-width">
                    <label for="start_date">Дата начала турнира:</label>
                    <input type="date" name="end_date" id="end_date" value="{{ $tournament->start_date }}">
                </div>
                <div class="form-group half-width">
                    <label for="end_date">Дата завершения турнира:</label>
                    <input type="date" name="end_date" id="end_date" value="{{ $tournament->end_date }}">
                </div>
            </div>


            <!-- Статичные поля -->
            <div class="form-group" style="color: brown">
                <label style="color: brown">Создатель:</label>
                <p>{{ $tournament->user->surname ?? '' }} {{ $tournament->user->name ?? '' }}</p>
            </div>

            <!-- Ошибки -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Кнопка сохранить -->
            <button id="save-description" style="margin-top: 10px; padding: 0.5rem 1rem; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Сохранить</button>

        </form>
    </section>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const editor = document.getElementById("description-editor");

        // Если текст из базы данных содержит HTML-разметку, можно использовать innerHTML
        editor.value = `{{ $tournament->description }}`;

        // Функция для обработки ввода в textarea
        editor.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Предотвращаем стандартное поведение Enter

                const cursorPosition = editor.selectionStart;
                const textBefore = editor.value.substring(0, cursorPosition);
                const textAfter = editor.value.substring(cursorPosition);

                // Вставляем новую строку с HTML-абзацем
                editor.value = `${textBefore}\n\n${textAfter}`;

                // Перемещаем курсор после вставленного абзаца
                editor.selectionStart = editor.selectionEnd = cursorPosition + 1;
            }
        });

        // Пример сохранения текста (отправка на сервер)
        document.getElementById("save-description").addEventListener("click", function() {
            const descriptionContent = editor.value;

            // Здесь можно отправить данные на сервер через AJAX
            console.log("Сохранённое описание:", descriptionContent);
        });
    });
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
        color: #007bff;
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
        margin-bottom: 0.6rem;
        color: #555;
    }

    p {
        padding: 0.6rem;
        background: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    input[type="text"],
    input[type="date"],
    select {
        width: 100%;
        padding: 0.6rem;
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

    .form-row {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
    }

    .half-width {
        flex: 1;
    }

    .form-row .half-width input,
    .form-row .half-width select {
        width: 100%;
    }
</style>
