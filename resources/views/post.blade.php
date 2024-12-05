@include('header')

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Новость</title>

    <link href="https://fonts.googleapis.com/css2?family=Menlo&display=swap" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    @if(!empty($post->images->first()->image))
        <img src="{{ asset('storage/' . $post->images->first()->image) ?? 'путь_по_умолчанию.jpg' }}" alt="Новость 1">
    @endif
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->created_at->format('d.m.Y H:i') }}</p>

    @foreach (explode("\n", $post->content) as $paragraph)
        <p>{{ $paragraph }}</p>
    @endforeach
</div>
</body>
</html>

@include('footer')


<style>
    body {
        font-family: 'Menlo', 'TT Commons Pro', 'TT Livret Text', sans-serif; /* Похожий на выбранный вами стиль шрифт */
        background-color: #fff;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 80%;
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem;
    }
    img{
        width: 100%;
    }

    h2 {
        font-size: 2.5rem;
        color: #1a1a70; /* Цвет для заголовка */
        text-align: center;
        margin-bottom: 1rem;
    }

    p {
        font-size: 1rem;
        color: #333;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    /* Стили для текста с абзацами */
    p {
        text-align: justify;
    }


    /* Стили для мобильных устройств */
    @media screen and (max-width: 768px) {
        .container {
            width: 90%;
            padding: 1rem;
        }

        h2 {
            font-size: 2rem;
        }

        p {
            font-size: 0.9rem;
        }
    }
</style>
