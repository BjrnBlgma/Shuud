<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Уведомление об участии</title>
</head>
<body>
<div class="container">
    <div class="header">
        <img src="https://via.placeholder.com/80" alt="Орнамент">
        <h1>Добро пожаловать в турнир!</h1>
    </div>
    <div class="content">
        <p>Уважаемый(ая), {{ $name }}!</p>
        <p>Вы успешно допущены к участию в турнире. Мы рады видеть вас среди участников и желаем удачи!</p>
        <p>Для подтверждения вашего участия, пожалуйста, перейдите по следующей ссылке:</p>
        <a href="{{ $link }}">Участвую!</a>
    </div>
    <div class="ornament">
        <img src="https://via.placeholder.com/500x50" alt="Бурятский орнамент">
    </div>
    <div class="footer">
        <p>С уважением, Президент ФБШ-Т Очиров Дагба</p>
    </div>
</div>
</body>
</html>


<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f5f0;
        color: #333333;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 600px;
        margin: 20px auto;
        background-color: #ffffff;
        border: 1px solid #d6cfc7;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .header {
        background-color: #0059b3;
        color: #ffffff;
        padding: 20px;
        text-align: center;
    }
    .header img {
        width: 80px;
        border-radius: 50%;
        margin-bottom: 10px;
    }
    .header h1 {
        margin: 0;
        font-size: 24px;
    }
    .content {
        padding: 20px;
    }
    .content p {
        font-size: 16px;
        line-height: 1.5;
    }
    .content a {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #e75d29;
        color: #ffffff;
        text-decoration: none;
        font-weight: bold;
        border-radius: 4px;
    }
    .content a:hover {
        background-color: #d64c1d;
    }
    .footer {
        background-color: #f1e7d3;
        text-align: center;
        padding: 10px;
        font-size: 12px;
    }
    .ornament {
        margin-top: 20px;
        text-align: center;
    }
    .ornament img {
        width: 80%;
    }
</style>
