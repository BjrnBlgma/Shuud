@include('admin.headerAdmin')

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    @if(!empty($tournament))
        <title>{{ $tournament->name }}</title>
</head>

<div class="tournament-details-container">
    <table class="tournament-details-table">
        <tr>
            <th>Название турнира</th>
            <td>
                <a href="{{ route('info-tournament', $tournament->id) }}">
                    {{ $tournament->name }}
                </a>
            </td>
        </tr>
        <tr>
            <th>Статус</th>
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
        </tr>
        <tr>
            <th>Кол-во участников</th>
            <td class="status-registration"> {{ count($tournament->tournamentParticipants) ?? '0' }}</td>
        </tr>
        <tr>
            <th>Дата начала</th>
            <td>{{ $tournament->start_date }}</td>
        </tr>
        <tr>
            <th>Дата завершения</th>
            <td>{{ $tournament->end_date }}</td>
        </tr>
        <tr>
            <th>Местоположение</th>
            <td>{{ $tournament->location }}</td>
        </tr>
        <tr>
            <th>Создатель</th>
            <td>{{ $tournament->user->surname ?? ''}} {{$tournament->user->name ?? ''}}</td>
        </tr>
        <tr>
            <th>Дата создания</th>
            <td>{{ $tournament->created_at->format('d.m.Y H:i') }}</td>
        </tr>
        <tr>
            <th>Дата изменения</th>
            <td>{{ $tournament->updated_at->format('d.m.Y H:i') }}</td>
        </tr>
    </table>

{{--    @if($tournament->status === 'registration of athletes') @endif--}}
    @if(!empty($tournament->tournamentParticipants))
        <a href=" {{route('list-of-participants', ["tournament_id" => $tournament->id] )}}">
            <button id="edit-toggle-btn" class="btnEdit" style="background-color:blue; color: white "> Список всех участников</button>
        </a>
    @endif

    <a href="{{ route('add-athlete', ["tournament_id" => $tournament->id]) }}">
        <button id="edit-toggle-btn" class="btnAdd fa fa-plus bg-1 text-fff" style="background-color:yellowgreen; color: white "> Добавить участника</button>
    </a>

    @endif
</div>

<style>
    body {
        font-family: Arial, sans-serif;
        line-height: 2;
        background-color: #f4f4f4;
        margin-left: auto;
        width: 1600px;
        padding: 20px;
    }
    .tournament-details-container {
        width: 50%;
        margin-top: 5rem;
    }

    .tournament-details-table {
        width: 100%;
        border-collapse: collapse;
    }

    .tournament-details-table th{
        border: 2px solid #ddd;
        padding: 8px;
        text-align: left;
        width: 200px;
    }
    .tournament-details-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .tournament-details-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
    .btnEdit, .btnAdd{
        display: block;
        margin-bottom: 5px;
        margin-top: 20px;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
    }

    .status-active { color: green; }
    .status-registration { color: blue; }
    .status-completed { color: gray; }
    .status-upcoming { color: orange; }
</style>
