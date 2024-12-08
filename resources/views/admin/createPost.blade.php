@include('admin.headerAdmin')

<main role="main" id="site-content">
    <section class="panel important">
        <h2>Создать {{ $postType->name ?? '' }}</h2>
        <form action="{{ route('create-post') }}" method="post" class="add-post-form" enctype="multipart/form-data">
            @csrf
            <div class="twothirds">
                Заголовок:<br/>
                <input type="text" name="title" size="40" value="{{ old('title') }}" /><br/><br/>
                Текст:<br/>
                <textarea name="content" rows="15" cols="67">{{ old('content') }}</textarea><br/>
            </div>
            <div class="twothirds">
                <input type="hidden" name="author_id" value="{{ $user->id }}">
                <input type="hidden" name="post_type_id" id="post_type_id" value="{{ $postType->id ?? '' }}">
            </div>

            <div class="twothirds">
                <label for="image">Добавить изображение:</label>
                <input type="file" name="image" id="image">
                <button type="submit" name="submit">Создать</button>
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
    }


    /* фон белый за формаой создания */
    .panel {
        background-color: white;
        color: darkslategray;
        -webkit-border-radius: 0.3rem;
        -moz-border-radius: 0.3rem;
        -ms-border-radius: 0.3rem;
        border-radius: 0.3rem;
        margin: 1%;
    }
    .panel > h2, .panel > ul {
        margin: 1rem;
    }


    /* создать новость/положение турнира/медиа */
    form input,
    form textarea,
    form select {
        width: 100%;
        display: block;
        border: solid 1px #dde;
        padding: 0.5em;
    }
    form input:after,
    form textarea:after,
    form select:after {
        content: "";
        display: table;
        clear: both;
    }
    form input[type="checkbox"],
    form input[type="radio"] {
        display: inline;
        width: auto;
    }
    form label,
    form legend {
        display: block;
        margin: 1em 0 0.5em;
    }
    form button[type="submit"] {
        background: #ff1a1a;
        border: none;
        border-bottom: solid 4px #e60000;
        padding: 0.7em 3em;
        margin: 1em 0;
        color: white;
        text-shadow: 0 -1px 0 #e60000;
        font-size: 1.1em;
        font-weight: bold;
        display: inline-block;
        width: auto;
        -webkit-border-radius: 0.5em;
        -moz-border-radius: 0.5em;
        -ms-border-radius: 0.5em;
        border-radius: 0.5em;
    }
    form button[type="submit"]:hover {
        background: turquoise;
        border: none;
        border-bottom: solid 4px #21ccbb;
        padding: 0.7em 3em;
        margin: 1em 0;
        color: white;
        text-shadow: 0 -1px 0 #21ccbb;
        font-size: 1.1em;
        font-weight: bold;
        display: inline-block;
        width: auto;
        -webkit-border-radius: 0.5em;
        -moz-border-radius: 0.5em;
        -ms-border-radius: 0.5em;
        border-radius: 0.5em;
    }
</style>
