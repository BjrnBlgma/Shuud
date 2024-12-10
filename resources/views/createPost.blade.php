@include('header')

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавить новость</title>

    <!-- Подключение CSS -->
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<div class="container py-4">
    <div class="form-container">

        <!-- Форма -->
        <form action="{{ route('create-post') }}" method="post" class="add-post-form" enctype="multipart/form-data">
            @csrf <!-- CSRF-токен -->

            <h3 class="form-title">Добавить новость</h3>

            <div class="form-group">
                <label for="newsTitle" class="form-label">Заголовок</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Введите заголовок" value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label for="newsText" class="form-label">Текст</label>
                <textarea class="form-control" id="content" rows="5" name="content" placeholder="Введите текст">{{ old('content') }}</textarea>
            </div>

            <input type="hidden" name="author_id" value="{{ $userId }}">

            <div class="form-group">
                <label for="postTypeId" class="form-label">Тип поста</label>
                <select id="post_type_id" name="post_type_id" class="form-control">
                    <option value="1" {{ old('post_type_id') == 1 ? 'selected' : '' }}>Новости</option>
                    <option value="2" {{ old('post_type_id') == 2 ? 'selected' : '' }}>Турнир</option>
                    <option value="3" {{ old('post_type_id') == 3 ? 'selected' : '' }}>Медиа</option>
                </select>
            </div>

            <label for="image">Добавить изображение:</label>
            <input type="file" name="image[]" id="image" required multiple>

            <!-- Вывод ошибок -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit" class="btn btn-primary">Создать пост</button>
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
