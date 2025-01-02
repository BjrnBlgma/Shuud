@include('header')

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Новость</title>
</head>
<body>

<div class="container py-4">

    @if(!empty($post->postFile))

    <div class="carousel">
        <div class="carousel-inner">
            @foreach($post->postFile as $file)
            <div class="carousel-item">
                <img src="{{ asset('storage/' . $file->file->path) ?? 'путь_по_умолчанию.jpg' }}"  alt="Image 1">
            </div>
            @endforeach
        </div>
    </div>
{{--        alt="Новость 1">--}}
    @endif
    <h2>{{ $post->title }}</h2>
    <p id="post">{{ $post->created_at->format('d.m.Y H:i') }}</p>

    @foreach (explode("\n", $post->content) as $paragraph)
        <p>{{ $paragraph }}</p>
    @endforeach
</div>
</body>
</html>

@include('footer')


<script>
    let currentIndex = 0;
    const carouselItems = document.querySelectorAll('.carousel-item');

    function goToSlide(index) {
        if (index &lt; 0) {
            index = carouselItems.length - 1;
        } else if (index &gt;= carouselItems.length) {
            index = 0;
        }
        currentIndex = index;
        document.querySelector('.carousel-inner').style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    function goToNextSlide() {
        goToSlide(currentIndex + 1);
    }

    function goToPrevSlide() {
        goToSlide(currentIndex - 1);
    }

    setInterval(goToNextSlide, 5000);
</script>


<style>
    body {
        font-family: 'Roboto', sans-serif;
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
    /*img{*/
    /*    width: 50%;*/
    /*}*/

    .carousel {
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    .carousel-inner {
        display: flex;
        width: 100%;
        transition: transform 0.5s;
    }

    .carousel-item {
        flex: 1;
        text-align: center;
    }

    .carousel-item img {
        width: 100%;
        max-height: 800px;
        object-fit: cover;
    }

    h2 {
        font-size: 2.5rem;
        color: #1a1a70; /* Цвет для заголовка */
        text-align: center;
        margin-bottom: 1rem;
    }

    p .post {
        font-size: 1rem;
        color: #333;
        line-height: 1.6;
        margin-bottom: 1rem;
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
