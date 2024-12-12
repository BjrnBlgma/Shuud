@include('admin.headerAdmin')


<main role="main" id="site-content">
    <section class="panel important">
        <h2>Создать турнир</h2>
        <form action="{{ route('add-tournament') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Название турнира:</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Описание:</label>
                <input type="text" name="description" id="description" value="{{ old('description') }}" >
            </div>

            <div class="form-row">
                <div class="form-group half-width">
                    <label for="start_date">Дата начала турнира:</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}">
                </div>
                <div class="form-group half-width">
                    <label for="end_date">Дата завершения турнира:</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" >
                </div>
            </div>

            <div class="form-group">
                <label for="location">Место проведения:</label>
                <input type="text" name="location" id="location" value="{{ old('location') }}" >
            </div>

            <div class="form-group">
                <label for="status">Статус турнира:</label>
                <select id="status" name="status">
                    <option value="upcoming" {{ old('status') == 'upcoming' ? 'selected' : '' }}>Турнир запланирован (в будущем)</option>
                    <option value="registration_of_athletes" {{ old('status') == 'registration_of_athletes' ? 'selected' : '' }}>Старт регистрации спортсменов</option>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Турнир идёт (сейчас)</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}> Турнир завершён</option>
                </select>
            </div>

            <div class="form-group">
                <label class="author" for="created_user_id">Судья: {{$user->surname}} {{$user->name}}</label>
                <input type="hidden" name="created_user_id" value="{{ $user->id }}" required>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit" class="btn-submit">Создать турнир</button>
        </form>
    </section>
</main>

<style>
    @charset "UTF-8";
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic);
    @import url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css);
    html {
        box-sizing: border-box;
    }

    *,
    *:before,
    *:after {
        box-sizing: inherit;
    }

    body {
        background: #f1f2f7;
        color: darkslategray;
        font-family: "Open Sans", Arial, sans-serif;
        margin-left: 15%;
    }

    h2 {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 1rem;
        color: #ff1a1a;
    }

    .panel {
        background-color: #fff;
        margin: 2rem auto;
        padding: 1.2rem;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 1000px;
    }

    .form-group {
        margin-bottom: 1.4rem;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 0.6rem;
        color: #555;
    }
    .author{
        display: flex;
        justify-content: right;
        margin-right: 10%;
    }

    input[type="text"],
    input[type="date"],
    select {
        width: 100%;
        padding: 0.6rem;
        font-size: 1rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        background: #f9f9f9;
        transition: border-color 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="date"]:focus,
    select:focus {
        border-color: #007bff;
        outline: none;
    }

    .btn-submit {
        display: block;
        width: 100%;
        padding: 0.8rem;
        font-size: 1rem;
        color: #fff;
        background: #007bff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-align: center;
        transition: background 0.3s ease;
    }

    .btn-submit:hover {
        background: #0056b3;
    }

    .form-group p {
        margin: 0;
        font-size: 0.9rem;
        color: #666;
    }

    .form-row {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
    }

    .half-width {
        flex: 1;
    }

    .form-row .half-width input,
    .form-row .half-width select {
        width: 100%;
    }
</style>
