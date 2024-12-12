<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Успешная регистрация</title>

</head>
<body>
<div class="success-container">
    <h1>Регистрация прошла успешно!</h1>
    <p>Вы успешно зарегистрировались на турнир. Желаем удачи!</p>
    <a href="{{ route('main') }}">Вернуться на главную</a>
</div>
</body>
</html>

<style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }
    .success-container {
        margin: 100px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
    }
    .success-container h1 {
        color: #28a745;
        margin-bottom: 20px;
    }
    .success-container p {
        color: #333;
        margin-bottom: 30px;
    }
    .success-container a {
        display: inline-block;
        padding: 10px 20px;
        color: #fff;
        background-color: #007bff;
        text-decoration: none;
        border-radius: 5px;
    }
    .success-container a:hover {
        background-color: #0056b3;
    }
</style>
