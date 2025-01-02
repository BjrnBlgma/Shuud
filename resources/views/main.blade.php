@include('header')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
</head>

<section class="news-section">
    <nav class="nav-news">
    <h2>Новости</h2>
    <a href="{{ route('news') }}" >Все новости &gt;</a>
    </nav>
    <div class="news-grid">
        @if(!empty($posts))
        @foreach($posts as $post)
            <article class="news-item">
                @if(!empty($post->postFile))
                    @php
                        $firstPostFile = $post->postFile->first(); // Получаем первое фото
                    @endphp
                    @if($firstPostFile && $firstPostFile->file)

                <img src="{{ asset('storage/' . $firstPostFile->file->path) ?? 'путь_по_умолчанию.jpg' }}" alt="Новость 1">

                    @endif
                @endif
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->created_at->format('d.m.Y H:i') }}</p>
                <p>{{ $post->getShortContent(2) }}</p>
                <a href="{{ route('posts.show', $post->id) }}" class="read-more">Читать далее</a>
            </article>
        @endforeach
        @endif
    </div>
</section>


@include('footer')

<script>
    const nav = document.querySelector('.main-navigation');
    window.addEventListener("scroll", function () {
        if (window.scrollY > 20) { // Изменено с document.documentElement.scrollTop на window.scrollY
            nav.classList.add("sticky");
        } else {
            nav.classList.remove("sticky");
        }
    });
</script>


<style>
    :root {
        --primary-color: #003357;
        --secondary-color: #8B4513;
        --accent-color: #4A90E2;
        --text-color: #00000;
        --background-color: #F3EFEA;
    }

    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        color: var(--text-color);
        background-color: var(--background-color);
    }



    /* News Styles */
    .news-section {
        padding: 4rem 20rem;
    }

    .news-section h2 {
        text-align: center;
        margin-bottom: 2rem;
        font-size: 3rem;
    }

    .news-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 1rem;
        margin-top: 3rem;
    }

    .news-item {
        display: flex;
        flex-direction: column; /* Расположить элементы вертикально */
        justify-content: space-between; /* Пространство между элементами */
        height: 100%; /* Задать высоту для равномерного распределения */
        background-color: white;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        overflow: hidden;
        padding-bottom: 1px; /* Добавить отступ для нижнего элемента */
    }

    .news-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .news-item h3 {
        font-size: 1.2rem;
        margin: 1rem;
    }

    .news-item p {
        font-size: 0.9rem;
        color: #666;
        margin: 0 1rem 1rem;
    }

    .news-item .read-more {
        margin-top: auto; /* Отправляет ссылку в нижнюю часть карточки */
        display: block;
        background-color: #1c542d;
        color: white;
        text-align: center;
        text-decoration: none;
        padding: 0.5rem 1rem;
        transition: background-color 0.4s;
    }

    .news-item .read-more:hover {
        background-color: #158078;
    }

    .nav-news {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px;
        border-bottom: 2px solid #efefef;
    }

    .nav-news h2 {
        font-size: 3rem;
        text-transform: uppercase;
        margin: 0;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }

    .nav-news a {
        font-size: 1rem; /* Размер шрифта меньше заголовка */
        color: #1a1a70; /* Темно-синий цвет */
        text-transform: uppercase;
        text-decoration: none;
        position: absolute;
        right: 20%;
    }

    .nav-news a:hover {
        text-decoration: underline;
    }
</style>
