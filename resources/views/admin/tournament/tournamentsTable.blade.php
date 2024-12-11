@include('admin.headerAdmin')

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список турниров</title>
</head>
<body>
<div class="tournaments-container">
    <h1>Список турниров</h1>
    <table class="tournaments-table">
        <thead>
        <tr>
            <th>№</th>
            <th>Название турнира</th>
            <th>Статус</th>
            <th>Кол-во участников</th>
            <th>Дата начала</th>
            <th>Дата завершения</th>
            <th>Местоположение</th>
            <th>Создатель</th>
            <th>Дата создания</th>
            <th>Дата изменения</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($allCompetitions))
            @php $i=1 @endphp
            @foreach($allCompetitions as $tournament)
            <tr>
                <td>{{ $i++ }}</td>
                <td><a href="{{ route('info-tournament', $tournament->id) }}"> {{ $tournament->name }} </a></td>

                <td>
                    @switch($tournament->status)
                        @case('active')
                            <span class="status-active">Активен</span>
                            @break
                        @case('registration of athletes')
                            <span class="status-registration">Регистрация спортсменов</span>
                            @break
                        @case('completed')
                            <span class="status-completed">Завершен</span>
                            @break
                        @case('upcoming')
                            <span class="status-upcoming">Предстоящий</span>
                            @break
                    @endswitch
                </td>

                @if(!empty($tournament->tournamentParticipants))
                <td style="text-align: center">{{ count($tournament->tournamentParticipants) ?? '0' }}</td>
                @else
                    <td style="text-align: center">0</td>
                @endif
                <td>{{ $tournament->start_date }}</td>
                <td>{{ $tournament->end_date }}</td>
                <td>{{ $tournament->location }}</td>
                <td>{{ $tournament->user->surname ?? ''}} {{$tournament->user->name ?? ''}}</td>
                <td>{{ $tournament->created_at->format('d.m.Y H:i') }}</td>
                <td>{{ $tournament->updated_at->format('d.m.Y H:i') }}</td>
                <td>
                    <div class="cell cell-100 text-center">
                    <a href="{{ route('edit-post', $tournament->id) }}" class="btnEdit fa fa-pencil bg-1 text-fff"> Редактировать</a>
                    <a href="{{ route('delete-post', $tournament->id) }}" class="btnRemove fa fa-remove bg-1 text-fff" onclick="return confirm('Вы уверены?')"> Удалить</a>
                    </div>
                </td>
            </tr>
        @endforeach
        @endif
        </tbody>
    </table>
</div>
</body>
</html>

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
        color: orange;
    }
    .status-registration{
        color: blue;
    }


    .btnEdit, .btnRemove {
        padding: 0.5em;
        margin: 0 2px;
    }
</style>
