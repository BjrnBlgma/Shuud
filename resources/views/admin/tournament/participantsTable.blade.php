@include('admin.headerAdmin')

    <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список участников</title>
</head>

<body>
<div class="tournaments-container">
    <h1>Список участников</h1>
    <div class="back" style="color: black; text-align: left; margin-top: -20px; margin-bottom: 20px; display: flex; justify-content: space-between ">
        <a href="javascript:history.back()">&#11178; Вернуться назад</a>

        <a href="{{ route('add-athlete', ["tournament_id" => $tournament->id]) }}">
            <button id="edit-toggle-btn" class="btnAdd fa fa-plus bg-1 text-fff"
                    style="background-color:yellowgreen; color: white; margin-top: 30px "> Добавить участника
            </button>
        </a>
    </div>
    <table class="tournaments-table">
        <thead>
        <tr>
            <th>№</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Допуск</th>
            <th>Статус</th>
            <th>Регион</th>
            <th>Город</th>
            <th>Телефон</th>
            <th>Email</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($tournament))
            @foreach($tournament->tournamentParticipants as $tournamentParticipant)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tournamentParticipant->participant->surname }} </td>
                    <td>{{$tournamentParticipant->participant->name}}</a></td>
                    <td>
                        @switch($tournamentParticipant->is_confirmed)
                            @case(true)
                                <span class="status-true">Допущен</span>
                                @break
                            @case(false)
                                <span class="status-false">Не допущен</span>
                                @break
                        @endswitch
                    </td>

                    <td>{{ $tournamentParticipant->status_label }}</td>

                    <td>{{ $tournamentParticipant->participant->region }}</td>
                    <td>{{ $tournamentParticipant->participant->city }}</td>
                    <td>{{ $tournamentParticipant->participant->phone }}</td>
                    <td>{{ $tournamentParticipant->participant->email}}</td>
                    <td>
                        <div class="cell cell-100 text-center">
                            <a href="" class="btnEdit fa fa-pencil bg-1 text-fff"></a>
                            <a href="" class="btnRemove fa fa-remove bg-1 text-fff"
                               onclick="return confirm('Вы уверены?')"></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
</body>

<style>
    body {
        font-family: Arial, sans-serif;
        line-height: 2;
        background-color: #f4f4f4;
        margin-left: auto;
        width: 1600px;
        padding: 20px;
    }

    .tournaments-container {
        background-color: white;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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

    .status-true {
        color: green;
        font-weight: bold;
    }

    .status-false {
        color: #e60000;
    }


    .btnEdit, .btnRemove {
        padding: 0.5em;
        margin: 0 2px;
    }
    .back {
        text-align: left;
        margin: 10px 0 20px 0;
        font-size: 16px;
        font-weight: bold;
    }

    .back a {
        text-decoration: none;
        color: black;
        font-weight: normal;
        display: inline-block;
    }

    .back a:hover {
        text-decoration: underline;
        color: blue;
    }
</style>
