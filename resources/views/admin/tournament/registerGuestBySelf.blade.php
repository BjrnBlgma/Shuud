<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;700&family=TT+Commons:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="title">Регистрация для участия в турнире</h1>

    <form action="{{ route('register-guest', ["tournament_id" => $tournament->id, 'registration_token' => $tournament->registration_token]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Имя:</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="surname">Фамилия:</label>
            <input type="text" name="surname" value="{{ old('surname') }}" required>
        </div>

        <div class="form-group">
            <label for="region">Регион:</label>
            <input type="text" name="region" value="{{ old('region') }}" required>
        </div>

        <div class="form-group">
            <label for="city">Город:</label>
            <input type="text" name="city" value="{{ old('city') }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Телефон:</label>
            <input type="text" name="phone" value="{{ old('phone') }}">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <input type="hidden" name="tournament_id" value="{{ $tournament->id }}">

        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button type="submit">Зарегистрироваться</button>
    </form>

    <div class="links">
        <a class="register-link" onclick="window.history.back();">Отмена</a>
    </div>
</div>
</body>
</html>

<style>
    body {
        font-family: 'TT Commons', 'Noto Serif', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #F3EFEA; /* Приятный светлый тон */
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .container {
        width: 50%; /* Контейнер занимает половину ширины страницы */
        max-width: 600px;
        background-color: #ffffff;
        border: 1px solid #D4AF37; /* Тонкая золотистая рамка */
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        padding: 40px; /* Увеличено внутреннее пространство */
        margin: 20px;
        text-align: left;
        position: relative;
    }

    /* Добавление рамки с узором */
    .container::before {
        content: "";
        position: absolute;
        top: -10px;
        right: -10px;
        bottom: -10px;
        left: -10px;
        border: 3px solid #5B84B1FF; /* Узор в виде синей рамки */
        border-radius: 12px;
        pointer-events: none; /* Чтобы рамка не мешала взаимодействию с формой */
    }

    .title {
        font-size: 1.5rem;
        color: #2F4F4F; /* Темно-зеленый тон */
        margin-bottom: 20px;
        text-align: center;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .form-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    label {
        width: 30%; /* Ширина label фиксирована */
        text-align: right;
        font-size: 0.9rem;
        color: #2E4053;
    }

    input, select {
        width: 70%; /* Поле ввода занимает оставшееся пространство */
        padding: 10px;
        font-size: 1rem;
        border: 1px solid #CCCCCC;
        border-radius: 5px;
        background-color: #FAFAFA;
    }

    input:focus, select:focus {
        border-color: #A5D6A7; /* Светло-зеленая подсветка при фокусе */
        outline: none;
    }

    button {
        width: 100%; /* Кнопка занимает всю ширину */
        padding: 10px;
        font-size: 1rem;
        color: #ffffff;
        background-color: #2E8B57; /* Цвет кедровой зелени */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #3CB371;
    }

    .error-messages {
        background-color: #FFDDDD;
        color: #8B0000;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .links {
        position: absolute;
        bottom: 10px;
        right: 8%;
    }

    .register-link {
        font-size: 0.8rem; /* Уменьшенный размер шрифта для ссылки */
        color: #000000;
        text-decoration: none;
    }

    .register-link:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .container {
            width: 90%; /* Контейнер адаптируется под мобильные устройства */
            padding: 20px;
        }

        .form-group {
            flex-direction: column;
            align-items: flex-start;
        }

        label {
            text-align: left;
            width: 100%;
        }

        input, select {
            width: 100%;
        }
    }
</style>
