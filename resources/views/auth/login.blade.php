<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;700&family=TT+Commons:wght@400;500&display=swap" rel="stylesheet">

</head>
<body>
<div class="container">
    <h1 class="title">Вход</h1>

    @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label for="password">Пароль:</label>
        <input type="password" name="password" required>

        <button type="submit">Войти</button>
    </form>

    <div class="links">
        <a href="{{ route('register') }}">Зарегистрироваться</a>
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
        background-color: #ffffff;
        border: 1px solid #D4AF37; /* Тонкая золотистая граница */
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 100%;
        max-width: 350px; /* Сужаем контейнер */
        text-align: center;
        position: relative;
    }

    .container::before {
        content: "";
        position: absolute;
        top: -10px;
        right: -10px;
        bottom: -10px;
        left: -10px;
        border: 3px solid #5B84B1FF; /* Узор в виде синей рамки */
        border-radius: 12px;
        pointer-events: none;
    }

    .title {
        font-size: 1.5rem;
        color: #2F4F4F; /* Темно-зеленый тон для текста заголовка */
        margin-bottom: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    label {
        text-align: left;
        font-size: 0.9rem;
        color: #2E4053;
    }

    input {
        width: 100%;
        padding: 10px;
        font-size: 1rem;
        border: 1px solid #CCCCCC;
        border-radius: 5px;
        background-color: #FAFAFA;
        box-sizing: border-box; /* Учитываем отступы в размере */
    }

    input:focus {
        border-color: #A5D6A7; /* Светло-зеленая подсветка при фокусе */
        outline: none;
    }

    button {
        padding: 10px 20px;
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
        display: flex;
        justify-content: flex-end; /* Выравнивание по правому краю */
        margin-top: 15px;
    }

    .links a {
        font-size: 0.85rem;
        color: #2E8B57; /* Цвет ссылок */
        text-decoration: none;
    }

    .links a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .container {
            padding: 15px;
            max-width: 90%;
        }

        .title {
            font-size: 1.2rem;
        }
    }
</style>
