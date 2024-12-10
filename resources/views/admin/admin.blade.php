@include('admin.headerAdmin')


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
            <div class="table" id="site-content">
                <div class="row bg-1" id="site-content">
                    <div class="cell cell-50 text-center text-fff">ID</div>
                    <div class="cell cell-100 text-center text-fff">Тип поста</div>
                    <div class="cell cell-100 text-fff">Изображение</div>
                    <div class="cell cell-100p text-fff">Заголовок</div>
                    <div class="cell cell-100p text-fff">Автор</div>
                    <div class="cell cell-100p text-fff">Дата создания</div>
                    <div class="cell cell-100 text-center text-fff"><input type="checkbox" class="checkbox checkAll"
                                                                           name="statusAll" target=".status"></div>
                    <div class="cell cell-100 text-center text-fff">Редактировать</div>
                </div>
                <!--   BEGIN LOOP -->
                <ul>
                    @if(!empty($allPosts))
                    @foreach($allPosts as $post)
                        <li class="row" id="site-content">
                            <div class="cell cell-50 text-center">{{$post->id}}</div>
                            <div class="cell cell-100 text-center">{{$post->postType->name ?? 'Тип не задан'}}</div>
                            @if(!empty($post->postFile))
                                @php
                                    $firstPostFile = $post->postFile->first(); // Получаем первое фото
                                @endphp
                                @if($firstPostFile && $firstPostFile->file)
                                    <div class="cell cell-100 text-center">
                                        <a href="">
                                            <img src="{{ asset('storage/' . $firstPostFile->file->path) }}" alt="Post Image" width="50">
                                        </a>
                                    </div>
                                @endif
                            @endif
                            <div class="cell cell-100p"><a href="">{{ $post->title }}</a></div>
                            <div class="cell cell-100p"><a
                                    href="">{{$post->user->surname ?? ''}} {{$post->user->name ?? ''}}</a></div>
                            <div class="cell cell-100p text-fff">{{ $post->created_at->format('d.m.Y H:i') }}</div>
                            <div class="cell cell-100 text-center">
                                <input type="hidden" class="status" name="status" value="0">
                                <input type="checkbox" class="btnSwitch status" name="status">
                            </div>
                            <div class="cell cell-100 text-center">
                                <a href="{{ route('edit-post', $post->id) }}"
                                   class="btnEdit fa fa-pencil bg-1 text-fff"></a>
                                <a href="{{ route('delete-post', $post->id) }}"
                                   class="btnRemove fa fa-remove bg-1 text-fff"
                                   onclick='return confirm("Do you really want to remove it ?")'></a>
                            </div>
                        </li>
                    @endforeach
                    @endif

                </ul>
                <!--   END LOOP -->
            </div>
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
