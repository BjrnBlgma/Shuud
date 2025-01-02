<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вы снялись с турнира</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;700&family=TT+Commons:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="title">Вы снялись с участия</h1>
    <p>Мы сожалеем, что вы не сможете принять участие в турнире. </p>
        <p>Если вы передумаете, свяжитесь с организатором.</p>
</div>
</body>
</html>

<style>
    body {
        font-family: 'TT Commons', 'Noto Serif', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #F9F6F1;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .container {
        width: 50%;
        max-width: 800px;
        background-color: #ffffff;
        border: 1px solid #D4AF37;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        padding: 40px;
        margin: 20px;
        text-align: left;
        position: relative;
    }

    .container::before {
        content: "";
        position: absolute;
        top: -10px;
        right: -10px;
        bottom: -10px;
        left: -10px;
        border: 3px solid #5B84B1FF;
        border-radius: 12px;
        pointer-events: none;
    }

    .title {
        font-size: 2rem;
        color: #2F4F4F;
        margin-bottom: 20px;
        text-align: center;
    }


    label {
        margin-bottom: 10px;
        font-size: 1rem;
        color: #2E4053;
    }

    select {
        width: 100%;
        padding: 10px;
        font-size: 1rem;
        border: 1px solid #CCCCCC;
        border-radius: 5px;
        background-color: #FAFAFA;
    }

    select:focus {
        border-color: #A5D6A7;
        outline: none;
    }

    button {
        width: 100%;
        padding: 10px;
        font-size: 1rem;
        color: #ffffff;
        background-color: #2E8B57;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #3CB371;
    }

    .status-message {
        text-align: center;
        font-size: 1rem;
        color: #8B0000;
        margin-top: 20px;
    }
    p{
        text-align: center;
        font-size: 20px;
    }

    @media (max-width: 768px) {
        .container {
            width: 90%;
            padding: 20px;
        }
    }
</style>
