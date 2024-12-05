@include('header')

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавить изображение</title>

    <!-- Подключение CSS -->
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<div class="container py-4">
    <div class="form-container">

        <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="post_id">Post ID:</label>
            <input type="number" name="post_id" id="post_id" required>

            <label for="image">Upload Image:</label>
            <input type="file" name="image" id="image" value="{{ old('image') }}" required>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit">Upload</button>
        </form>
    </div>
</div>
</body>
</html>

<style>
    body {
        font-family: 'TT Livret Text', 'Menlo', sans-serif;
        background-color: #f6f6f6;
        color: #333;
        margin: 0;
        padding: 0;
    }

    /* Контейнер */
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Форма */
    .form-container {
        background: #fff;
        border: 2px solid #e5d5b0; /* Теплый бежевый цвет */
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        position: relative;
        margin-top: 3rem;
    }

    .form-container::before {
        content: '';
        position: absolute;
        top: -5px;
        right: -5px;
        bottom: -5px;
        left: -5px;
        border: 2px dashed #d5a373; /* Буддийский орнамент */
        border-radius: 12px;
        pointer-events: none;
    }

    .form-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 20px;
        color: #815f30; /* Теплый коричневый */
        text-align: center;
    }

    /* Поля формы */
    .form-group {
        margin-bottom: 15px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        color: #815f30;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1rem;
    }

    textarea.form-control {
        resize: vertical;
    }

    button {
        background: #815f30;
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
    }

    button:hover {
        background: #573b1d;
    }

    /* Хлебные крошки */
    .breadcrumb {
        background: none;
        padding: 0;
        margin-bottom: 15px;
    }

    .breadcrumb-item a {
        text-decoration: none;
        color: #815f30;
    }

    .breadcrumb-item.active {
        color: #a67b4a;
    }

    /* Адаптивность */
    @media (max-width: 600px) {
        .container {
            padding: 10px;
        }

        .form-title {
            font-size: 1.2rem;
        }
    }
</style>
