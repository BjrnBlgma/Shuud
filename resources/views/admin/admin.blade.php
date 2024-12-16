@include('admin.headerAdmin')
    <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список постов</title>
</head>

<main role="main" id="site-content">

    <section class="panel important">
        <form action="" method="GET" name="listForm" class="form scrollX">
            <div class="formHeader row">
                <h2 class="text-1 fl">Список постов</h2>
                <div class="fr">
                    <a href="{{ route('create-post', ['section' => 1]) }}" class="btnAdd fa fa-plus bg-1 text-fff">
                        СОЗДАТЬ НОВОСТЬ</a>
                    <a href="{{ route('create-post', ['section' => 3]) }}" class="btnAdd fa fa-plus bg-1 text-fff">
                        СОЗДАТЬ МЕДИА</a>
                    <a href="{{ route('create-post', ['section' => 2]) }}" class="btnAdd fa fa-plus bg-1 text-fff">
                        СОЗДАТЬ ПОЛОЖЕНИЕ ТУРНИРА</a>
                    {{--                    <button type="submit" class="btnSave bg-1 text-fff text-bold fr">Сохранить</button>--}}
                    {{--                    <a href="" class="btnAdd fa fa-plus bg-1 text-fff"></a>--}}
                </div>
            </div>

            <table class="tournaments-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Тип поста</th>
                    <th>Изображение</th>
                    <th>Заголовок</th>
                    <th>Описание</th>
                    <th>Автор</th>
                    <th>Дата создания</th>
                    <th>Действия</th>
                </tr>
                </thead>

                <tbody>
                    @if(!empty($allPosts))
                    @foreach($allPosts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{$post->postType->name ?? ''}}</td>

                            @if(!empty($post->postFile))
                                @php
                                    $firstPostFile = $post->postFile->first(); // Получаем первое фото
                                @endphp
                                @if($firstPostFile && $firstPostFile->file)
                            <td><img src="{{ asset('storage/' . $firstPostFile->file->path) }}" alt="Post Image" width="50" height="100%"></td>
                                @endif
                            @endif
                            <td>{{ $post->title }}</td>
                            <td>{{ Str::limit($post->content, 30) }}</td>
                            <td>{{ $post->user->surname ?? ''}} {{$post->user->name ?? ''}}</td>
                            <td>{{ $post->created_at->format('d.m.Y H:i') }}</td>
                            <td>
                                <div class="cell cell-100 text-center">
                                    <a href="{{ route('edit-post', $post->id) }}" class="btnEdit fa fa-pencil bg-1 text-fff"></a>
                                    <a href="{{ route('delete-post', $post->id) }}" class="btnRemove fa fa-remove bg-1 text-fff" onclick="return confirm('Вы уверены?')"></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>


                <!--   END LOOP -->

        </form>
    </section>
</main>


<style>

    .tournaments-container {
        background-color: white;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        padding: 20px;
        text-align: center;
    }
    .tournaments-table {
        width: 100%;
        border-collapse: collapse;
    }
    .tournaments-table th {
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }
    .tournaments-table td {
        border: 1px solid #ddd;
        padding: 12px;
    }
    .tournaments-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .tournaments-table tr:hover {
        background-color: #e8e8e8;
    }
    .status-active {
        color: green;
        font-weight: bold;
    }
    .status-completed {
        color: gray;
    }
    .status-upcoming {
        color: blue;
    }
    .status-registration{
        color: #857a11;
    }


    .btnEdit, .btnRemove {
        padding: 0.5em;
        margin: 0 2px;
    }
</style>
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
        line-height: 2;
    }

    body.login {
        background-color: white;
        max-width: 500px;
        margin: 10vh auto;
        padding: 1em;
        height: auto;
    }

    .warn {
        color: red;
    }


    /* белый фон */
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


    /*дизайн для списка новостей  */
    .form {
        background: #fff;
        border: 1px solid #dedede;
    }

    .formHeader {
        padding: 1em;
        background: #fff;
        border-bottom: 1px solid #dedede;
        display: flex;
        justify-content: space-between;
    }

    .formBody {
        width: 100%;
        padding: 20px 20px 10px 20px;
    }

    /* LIST FORM */
    .btnAdd, .btnSave, .btnEdit, .btnRemove {
        padding: 0.5em;
        margin: 0 2px;
    }

    .btnSave {
        border: none;
        outline: none;
        cursor: pointer;
        font-size: 0.95em;
    }

    .btnSwitch {
        font-size: 10px;
    }

    .btnSwitch.all {
        position: absolute;
        bottom: calc(100% + 3.7em);
        left: calc(50% - 4em);
    }

    .scrollX {
        width: 100%;
        overflow-x: scroll;
    }

    .table {
        width: 100%;
        min-width: 768px;
    }

    .table .row {
        width: 100%;
    }

    .table .row .cell {
        display: table-cell;
        padding: 10px;
        vertical-align: middle;
    }

    .table > ul > li {
        border-bottom: 1px solid #dedede;
    }

    .table .cell-50 {
        -max-width: 50px;
        min-width: 50px;
    }

    .table .cell-100 {
        -max-width: 100px;
        min-width: 100px;
    }

    .table .cell-150 {
        -max-width: 150px;
        min-width: 150px;
    }

    .table .cell-200 {
        -max-width: 200px;
        min-width: 200px;
    }

    .table .cell-100p {
        width: 100%;
    }
</style>
